# Import packages
import os
import sys


##tkinter imports
import tkinter
import tkinter.filedialog as tkFileDialog

###Loads the dialog box to ask for images
root = tkinter.Tk()
root.withdraw() #use to hide tkinter window
currdir = os.getcwd()
tempdir = tkFileDialog.askdirectory(parent=root, initialdir=currdir, title='Please select image folder')
files_path = [os.path.abspath(x) for x in os.listdir(tempdir)]


print(files_path[0])
