import os       # OS / command 
import time     # For Time Delay
import pymysql  # Mysql client for python

#2s delay per interval
DELAY = 2

# Create a connection object
dbServerName    = "den1.mysql4.gear.host"
dbUser          = "pestbuster"
dbPassword      = "Bq3!-9Y6v678"
dbName          = "pestbuster"
charSet         = "utf8mb4"


def readStatus():
    while True:
        try:
            cursorType      = pymysql.cursors.DictCursor
            connectionObject   = pymysql.connect(host=dbServerName, user=dbUser, password=dbPassword,db=dbName, charset=charSet, cursorclass=cursorType)
                    
            # Create a cursor object
            cursorObject = connectionObject.cursor()                                      
            
            # SQL query string
            sqlQuery = "SELECT * FROM cameradetails WHERE cameraID = '1'"

            # Execute the sqlQuery
            cursorObject.execute(sqlQuery)

            #Fetch all the rows
            rows = cursorObject.fetchall()

            #Commit connection
            connectionObject.commit()
            connectionObject.close()
            
            #Print the rows out
            for row in rows:
                return (row["state"])  
        except:
            print("SQL connection error")
            time.sleep(5)



def resetState():
    while True:
        try:
            cursorType      = pymysql.cursors.DictCursor
            connectionObject   = pymysql.connect(host=dbServerName, user=dbUser, password=dbPassword,db=dbName, charset=charSet, cursorclass=cursorType)
            sql = "UPDATE cameradetails SET state = 0 WHERE cameraID = 1"
            cursorObject = connectionObject.cursor()    
            cursorObject.execute(sql)
            connectionObject.commit()
            print ("STATE RESET!! Resuming back to wait")
            connectionObject.close()
            break
        except:
            print("SQL timeout, retrying")
            time.sleep(5)            





def updateDBInsectCount():
    file = open("result.txt", "r")
    
    camID = 1
    companyName = "SIT"
    
    houseFlies = 0
    fleshFlies = 0
    greenBottlesFlies = 0
    phoridOrHumpbackedFlies = 0
    flyingTermites = 0

    dateTime = time.strftime('%Y-%m-%d %H:%M:%S')
    status = 1

    for line in file:
        if line != "\n":
            words = line.split(":")
            insectName = words[0]
            insectCount = int(words[1])
            
            if insectName == "house fly":
                houseFlies = insectCount
            elif insectName == "flesh fly":
                fleshFlies = insectCount
            elif insectName == "green bottles fly":
                greenBottlesFlies = insectCount        
            elif insectName == "phoridOrHumpbackedFlies":
                phoridOrHumpbackedFlies = insectCount
            elif insectName == "flying termite":
                flyingTermites = insectCount

    cursorType = pymysql.cursors.DictCursor
    connectionObject   = pymysql.connect(host=dbServerName, user=dbUser, password=dbPassword,db=dbName, charset=charSet, cursorclass=cursorType)

    cursorObject = connectionObject.cursor()  
    sql = ("INSERT INTO fliesdetail(cameraID, companyName, houseFlies, fleshFlies, greenBottlesFlies, phoridOrHumpbackedFlies, flyingTermites, date) VALUES('%d','%s','%d','%d','%d','%d','%d','%s')" % (camID,companyName, houseFlies,fleshFlies,greenBottlesFlies,phoridOrHumpbackedFlies,flyingTermites,dateTime))
    cursorObject.execute(sql)
    connectionObject.commit()
    connectionObject.close()
    print ("--INSECT COUNT UPDATED TO DB--")
    os.remove("result.txt")

time.sleep(5)
print("System Ready") 

while True:
    if readStatus() == 0:
        time.sleep(DELAY)
    elif readStatus() == 1:
        print "Receive Commands"
        
        os.system("sudo python2 motor.py")  #Control motor + take photo

        ##TO DO: STITCH            
        os.system("sudo python2 stitch.py")  #Stitching images together

        ##TO DO: call "python3 object detection"

        os.chdir("/home/pi/Desktop/startup/object_detection")
        os.system("python3 Object_detection_image.py")
        os.chdir("/home/pi/Desktop/startup/")

        ##TO DO: call jiamin smaller insects
        os.system("python2 flies.py")  ##Done
        
        ##TO DO: combine everything save to DB
        updateDBInsectCount()
        
        ##TO DO: update state back to 0
        resetState()    #Done

    
