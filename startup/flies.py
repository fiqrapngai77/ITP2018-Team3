import numpy as np
import cv2
import os

def b_or_w(image, black_max_bgr=(40, 40, 40)):
    m_bgr_float = np.mean(image, axis=(0,1))
    m_bgr_rounded = np.round(m_bgr_float)
    m_bgr = m_bgr_rounded.astype(np.uint8)
    m_intensity = int(round(np.mean(image)))
    
    if np.all(m_bgr < black_max_bgr):
        return 'black'
    else:
        return 'white'


IMAGE_NAME = "final.jpg"

img = cv2.imread(IMAGE_NAME,0)


if (b_or_w(img)=='black'):
    ret, thresh = cv2.threshold(img,100,255,cv2.THRESH_BINARY_INV)
    
else :
    ret, thresh = cv2.threshold(img,100,255,cv2.THRESH_BINARY)
    

# noise removal
##defult values 5,5
kernel = np.ones((7,7),np.uint8)

opening = cv2.erode(thresh,kernel,iterations = 0)

# sure background area
sure_bg = cv2.dilate(opening,kernel,iterations=0)
#cv2.imshow('Sure background', sure_bg)

# Setup SimpleBlobDetector parameters.
params = cv2.SimpleBlobDetector_Params()
 
# Change thresholds
#for blob2
#params.minThreshold = 50;
#for blob3

params.minThreshold = 10;
params.maxThreshold = 400;
 
# Filter by Area.
params.filterByArea = True
params.minArea = 50
params.maxArea = 750
 
# Filter by Circularity
params.filterByCircularity = True
params.minCircularity = 0.01
 
# Filter by Convexity
params.filterByConvexity = True
params.minConvexity = 0.6
#params.maxConvexity = 0.9
 
# Filter by Inertia
params.filterByInertia = True
params.minInertiaRatio = 0.01

 
# Set up the detector with default parameters.

detector = cv2.SimpleBlobDetector(params)


keypoints = detector.detect(sure_bg)
im_with_keypoints = cv2.drawKeypoints(sure_bg, keypoints, np.array([]), (0,0,255), cv2.DRAW_MATCHES_FLAGS_DRAW_RICH_KEYPOINTS)


##cv2.imshow("Output", im_with_keypoints)

currentCount = str(len(keypoints))
print "Small flies Total: " + currentCount

with open("result.txt","a") as myfile:
    myfile.write("\n"+"phoridOrHumpbackedFlies:"+currentCount)

filename = "final.jpg"














