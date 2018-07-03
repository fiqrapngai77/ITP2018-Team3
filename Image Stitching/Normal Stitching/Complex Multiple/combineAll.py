#https://stackoverflow.com/questions/30227466/combine-several-images-horizontally-with-python

import numpy as np
from PIL import Image
import time

#list_im = ['a.jpg', 'b.jpg','c.jpg', 'd.jpg']
list_im = ['a.jpg', 'b.jpg']
imgs    = [ Image.open(i) for i in list_im ]
# pick the image which is the smallest, and resize the others to match it (can be arbitrary image shape here)
min_shape = sorted( [(np.sum(i.size), i.size ) for i in imgs])[0][1]
imgs_comb = np.hstack( (np.asarray( i.resize(min_shape) ) for i in imgs ) )

# save Vertical picture
imgs_comb = Image.fromarray( imgs_comb)
imgs_comb.save( 't1.jpg' )

##################################################

list_im = ['c.jpg', 'd.jpg']
imgs    = [ Image.open(i) for i in list_im ]
# pick the image which is the smallest, and resize the others to match it (can be arbitrary image shape here)
min_shape = sorted( [(np.sum(i.size), i.size ) for i in imgs])[0][1]
imgs_comb = np.hstack( (np.asarray( i.resize(min_shape) ) for i in imgs ) )

# save Vertical picture
imgs_comb = Image.fromarray( imgs_comb)
imgs_comb.save( 't2.jpg' )

##################################################

list_im = ['t1.jpg', 't2.jpg']
# Save Horizontal picture
# for a vertical stacking it is simple: use vstack
imgs    = [ Image.open(i) for i in list_im ]
min_shape = sorted( [(np.sum(i.size), i.size ) for i in imgs])[0][1]
imgs_comb = np.vstack( (np.asarray( i.resize(min_shape) ) for i in imgs ) )
imgs_comb = Image.fromarray( imgs_comb)
imgs_comb.save( 'final.jpg' )

print ("Completed")
