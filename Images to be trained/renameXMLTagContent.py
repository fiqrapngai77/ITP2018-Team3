from xml.etree import ElementTree as et
import os, glob

#testFormat
#FORMAT = "C:\\tensorflow1\\models\\research\\object_detection\\images\\test\\"

#trainFormat

##OLD_FORMAT = "termite"
##
##NEW_FORMAT = "flying termite"

##OLD_FORMAT = "fly"
##
##NEW_FORMAT = "house fly"

##OLD_FORMAT = "flesh flies"
##
##NEW_FORMAT = "flesh fly"

OLD_FORMAT = "green bottles flies"

NEW_FORMAT = "green bottles fly"

'''Get Current directory'''
cwd = os.getcwd()
'''Set current directory to execute'''
os.chdir(cwd)

count = 1

'''Loop thru the folder'''
for file in glob.glob("*"):
    if file.endswith(".xml"):
        tree = et.parse(file)
        root = tree.getroot()

        for name in root.iter('name'):
            if name.text == OLD_FORMAT:
                new_name = NEW_FORMAT
                name.text = str(new_name)
                tree.write(file)        
                print (file + " : " + str(count))
                count = count + 1


print ("Done")
