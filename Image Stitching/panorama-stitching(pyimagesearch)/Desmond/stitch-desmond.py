# Import the necessary packages
from pyimagesearch.panorama import Stitcher
import argparse
import imutils
import cv2
import os
import sys
import numpy as np

##tkinter imports
import tkinter
import tkinter.filedialog as tkFileDialog

#This entire part is the remove the black excess
def cutOffExcess(image):	
	grayscale = cv2.cvtColor(image,cv2.COLOR_BGR2GRAY)
	_,thresh = cv2.threshold(grayscale,100,255,cv2.THRESH_BINARY)
	contours = cv2.findContours(thresh,cv2.RETR_EXTERNAL,cv2.CHAIN_APPROX_SIMPLE)
	cnt = contours[0]
	x,y,w,h = cv2.boundingRect(cnt)
	cropped_img = image[y:y+h, x:x+w]
	return cropped_img

###Loads the dialog box to ask for images
root = tkinter.Tk()
root.withdraw() #use to hide tkinter window
currdir = os.getcwd()
tempdir = tkFileDialog.askdirectory(parent=root, initialdir=currdir, title='Please select image folder')	

###Initializes the selected directory
if len(tempdir) > 0:
    IMAGE_DIR = tempdir
	
###Initializes a list for the images and append the images in the folder	
image_list = []
for FILENAME in os.listdir(IMAGE_DIR):
	image_list.append(IMAGE_DIR + "/" + FILENAME)
	
# Get current directory
currdir = os.getcwd()

# Indicate the save directory folder
TO_SAVE_DIR = currdir + "\\saved\\"

# Check if the TO_SAVE directory exist, else create that empty directory
if not os.path.exists(TO_SAVE_DIR):
    os.makedirs(TO_SAVE_DIR)

# Inputs of images
'''
Notes: It can only stitch 2 images at a time
'''
imageA = cv2.imread(image_list[0])
imageB = cv2.imread(image_list[1])

# Stitch the images together to create a panorama, first round is kinda hardcoded
stitcher = Stitcher()
(result, vis) = stitcher.stitch([imageA, imageB], showMatches=True)

# From the third one onwards, it is automated
if(len(image_list)>2):
	counter = 2
	while(counter!=len(image_list)):
		imageC = cv2.imread(image_list[counter])
		(result, vis) = stitcher.stitch([cutOffExcess(result), imageC], showMatches=True)
		counter += 1

# Show the images
cv2.imshow("Image A", imageA)
cv2.imshow("Image B", imageB)
cv2.imshow("Keypoint Matches", vis)

newImg = cutOffExcess(result)

#cv2.imshow("Result", result)
cv2.imshow("Result", newImg)

#Save the image into saved directory folder
cv2.imwrite(TO_SAVE_DIR+"stitched.jpg" ,newImg)

# Press any key to close the image
cv2.waitKey(0)
# Clean up
cv2.destroyAllWindows()





