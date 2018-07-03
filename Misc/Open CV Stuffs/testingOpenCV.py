import numpy as np
import cv2


img = cv2.imread('testImage.png') #Path of the image

cv2.imshow('randomName',img) #Open the window with the image

k = cv2.waitKey(0)

if k == 27:         # wait for ESC key to exit
    cv2.destroyAllWindows()
