import os, glob

'''Format extension to add/change'''        
addFormat = ".jpg"

'''Get Current directory that contains all the images'''
cwd = os.getcwd()
print cwd
os.chdir(cwd)

count = 0

'''Loop through the folder'''
for file in glob.glob("*"):
    #(skip all py file extension)
    if file.endswith(".py"):
        continue
    #Skip all jpg and png picture format
    if not (file.endswith(".jpg") or file.endswith(".png")):
        #Look for file with other extension
        if '.' in file: #
            words = file.split(".")            
            #print words[0]+addFormat
            os.rename(file, words[0]+addFormat)
            count = count + 1
            print "[" + str(count) + "] :" + file + " updated"
        #Those without any file format
        else:
            #print(file+addFormat)
            os.rename(file, file+addFormat)
            count = count + 1
            print "[" + str(count) + "] :" + file + " updated"



print "Completed"
