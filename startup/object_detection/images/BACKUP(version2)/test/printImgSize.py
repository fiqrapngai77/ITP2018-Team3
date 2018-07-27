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
        print file + " : "+ str(im.size) + " : " +str(count)
        
      
