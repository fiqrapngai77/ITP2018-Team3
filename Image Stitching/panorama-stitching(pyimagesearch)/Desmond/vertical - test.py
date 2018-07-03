# Import the necessary packages
from pyimagesearch.panorama import Stitcher
import argparse
import imutils
import cv2
import os

'''
IMPORTANT
Height of the images must be the same
Vertical cannot be done for now
'''

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
imageA = cv2.imread("images/top.jpg")
imageB = cv2.imread("images/bottom.jpg")


# Stitch the images together to create a panorama
stitcher = Stitcher()
(result, vis) = stitcher.stitch([imageA, imageB], showMatches=True)


# Show the images
cv2.imshow("Image A", imageA)
cv2.imshow("Image B", imageB)
cv2.imshow("Keypoint Matches", vis)
cv2.imshow("Result", result)


#Save the image into saved directory folder
cv2.imwrite(TO_SAVE_DIR+"stiched.jpg" ,result)


# Press any key to close the image
cv2.waitKey(0)
# Clean up
cv2.destroyAllWindows()



