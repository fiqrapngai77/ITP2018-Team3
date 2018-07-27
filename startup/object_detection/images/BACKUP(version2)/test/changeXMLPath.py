from xml.etree import ElementTree as et
import os, glob

#testFormat
##FORMAT = "C:\\tensorflow1\\models\\research\\object_detection\\images\\test\\"

#trainFormat
FORMAT = "C:\\tensorflow1\\models\\research\\object_detection\\images\\train\\"

'''Get Current directory'''
cwd = os.getcwd()
'''Set current directory to execute'''
os.chdir(cwd)

count = 0

'''Loop thru the folder'''
for file in glob.glob("*"):
    if file.endswith(".xml"):
        tree = et.parse(file)

        #Split by backslash '\', need '\\' due to unicode
        tmpPath = tree.find('path').text.split("\\")

        #Image Name of the file
        imageName = tmpPath[-1]

        #Format to save
        pathToSave = FORMAT + imageName
        count = count + 1
        print pathToSave + " : DONE " + str(count)

        #Edit the path tag element
        tree.find('path').text = pathToSave
        
        #Save the xml file
        tree.write(file)
