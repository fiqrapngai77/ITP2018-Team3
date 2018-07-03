import numpy as np
import cv2

def b_or_w(image, black_max_bgr=(40, 40, 40)):
    m_bgr_float = np.mean(image, axis=(0,1))
    m_bgr_rounded = np.round(m_bgr_float)
    m_bgr = m_bgr_rounded.astype(np.uint8)
    m_intensity = int(round(np.mean(image)))
    
    if np.all(m_bgr < black_max_bgr):
        return 'black'
    else:
        return 'white'


IMAGE_NAME = "img.jpg"

img = cv2.imread(IMAGE_NAME,0)
img = cv2.resize(img, (1250, 650))

###VALUES here might need to change###
#ret, thresh = cv2.threshold(img,100,255,cv2.THRESH_BINARY_INV)
###VALUES here might need to change###

if (b_or_w(img)=='black'):
    ret, thresh = cv2.threshold(img,100,255,cv2.THRESH_BINARY_INV)
    
else :
    ret, thresh = cv2.threshold(img,100,255,cv2.THRESH_BINARY)
    

# noise removal
###VALUES here might need to change###
##defult values 5,5
kernel = np.ones((7,7),np.uint8)

opening = cv2.erode(thresh,kernel,iterations = 0)
cv2.imshow('image',opening)

# sure background area
sure_bg = cv2.dilate(opening,kernel,iterations=0)
#cv2.imshow('Sure background', sure_bg)

###VALUES here might need to change###

###---NOT USING---###
'''
# Finding sure foreground area
dist_transform = cv2.distanceTransform(opening,cv2.DIST_L2,5)
ret, sure_fg = cv2.threshold(dist_transform,0.4*dist_transform.min(),255,0)
##cv2.imshow('Sure Foreground', sure_fg)

### Finding unknown region
sure_fg = np.uint8(sure_fg)
##cv2.imshow('inv forground', sure_fg)
mask_inv = cv2.bitwise_not(sure_fg)       
'''
###---NOT USING---###

###LINK FOR REFERENCE
# https://www.learnopencv.com/blob-detection-using-opencv-python-c/
###

# Setup SimpleBlobDetector parameters.
params = cv2.SimpleBlobDetector_Params()
 
# Change thresholds
#for blob2
#params.minThreshold = 50;
#for blob3
###VALUES here might need to change###
params.minThreshold = 10;
params.maxThreshold = 400;
 
# Filter by Area.
params.filterByArea = True
params.minArea = 10
params.maxArea = 500
 
# Filter by Circularity
params.filterByCircularity = True
params.minCircularity = 0.01
 
# Filter by Convexity
params.filterByConvexity = True
params.minConvexity = 0.85
#params.maxConvexity = 0.9
 
# Filter by Inertia
params.filterByInertia = True
params.minInertiaRatio = 0.01
###VALUES here might need to change###
# Create a detector with the parameters
ver = (cv2.__version__).split('.')
if int(ver[0]) < 3 :
    detector = cv2.SimpleBlobDetector(params)
else : 
    detector = cv2.SimpleBlobDetector_create(params)

 

 
# Set up the detector with default parameters.
detector = cv2.SimpleBlobDetector_create(params)


    #Keypoint of the old image
#keypoints = detector.detect(im)
keypoints = detector.detect(sure_bg)
'''
for k in keypoints:
    cv2.circle(overlay, (int(k.pt[0]), int(k.pt[1])), int(k.size/2), (0, 0, 255), -1)
    cv2.line(overlay, (int(k.pt[0])-20, int(k.pt[1])), (int(k.pt[0])+20, int(k.pt[1])), (0,0,0), 3)
    cv2.line(overlay, (int(k.pt[0]), int(k.pt[1])-20), (int(k.pt[0]), int(k.pt[1])+20), (0,0,0), 3)
    '''
#im_with_keypoints = cv2.drawKeypoints(mask_inv, keypoints, np.array([]), (0,0,255), cv2.DRAW_MATCHES_FLAGS_DRAW_RICH_KEYPOINTS)
im_with_keypoints = cv2.drawKeypoints(sure_bg, keypoints, np.array([]), (0,0,255), cv2.DRAW_MATCHES_FLAGS_DRAW_RICH_KEYPOINTS)
#opacity = 0.5
#opacity = 1
#cv2.addWeighted(overlay, opacity, im, 1 - opacity, 0, im)

# Uncomment to resize to fit output window if needed
#im = cv2.resize(im, None,fx=0.5, fy=0.5, interpolation = cv2.INTER_CUBIC)
#cv2.waitKey(0)



cv2.imshow("Output", im_with_keypoints)

currentCount = str(len(keypoints))
print "Total: " + currentCount




cv2.waitKey(0)
cv2.destroyAllWindows()
