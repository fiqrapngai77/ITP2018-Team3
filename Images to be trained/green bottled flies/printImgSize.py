from PIL import Image
import os, glob



'''Get Current directory'''
cwd = os.getcwd()
'''Set current directory to execute'''
os.chdir(cwd)

count = 0

'''Loop thru the folder'''
for file in glob.glob("*"):
    if file.endswith(".jpg"):
        im = Image.open(file)
        width, height = im.size
        count = count + 1
        if (width or height) < 98:
            print "small"
            print file + " : "+ str(im.size) + " : " +str(count)
        elif (width or height) > 1024:
            print "big"
            print file + " : "+ str(im.size) + " : " +str(count)

        
'''
Try to remove to bigger or smaller files
'''
      
