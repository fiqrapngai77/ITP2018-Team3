import os, glob
import numpy as np
from PIL import Image


# Get current directory
currdir = os.getcwd() + "/images"

###Initializes a list for the images and append the images in the folder	
list_im = []
for FILENAME in os.listdir(currdir):
    print FILENAME
    list_im.append(currdir + "/" + FILENAME)	

#Sort the files from ascending order, assuming 1 number in each file name
list_im.sort(key=lambda f: int(filter(str.isdigit,f)))

imgs    = [ Image.open(i) for i in list_im ]
# pick the image which is the smallest, and resize the others to match it (can be arbitrary image shape here)
min_shape = sorted( [(np.sum(i.size), i.size ) for i in imgs])[0][1]
imgs_comb = np.hstack( (np.asarray( i.resize(min_shape) ) for i in imgs ) )

# save Vertical picture
imgs_comb = Image.fromarray( imgs_comb)
imgs_comb.save( 'final.jpg' )    
