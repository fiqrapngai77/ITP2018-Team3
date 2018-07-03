#https://stackoverflow.com/questions/30227466/combine-several-images-horizontally-with-python


'''
Combine image top and bottom stich
'''
import numpy as np
from PIL import Image


#list_im = ['a.jpg', 'b.jpg','c.jpg', 'd.jpg']
list_im = ['a.jpg', 'b.jpg']
imgs    = [ Image.open(i) for i in list_im ]
# pick the image which is the smallest, and resize the others to match it (can be arbitrary image shape here)
min_shape = sorted( [(np.sum(i.size), i.size ) for i in imgs])[0][1]
imgs_comb = np.hstack( (np.asarray( i.resize(min_shape) ) for i in imgs ) )

# save Vertical picture
imgs_comb = Image.fromarray( imgs_comb)
#imgs_comb.save( 'VerticalOne.jpg' )    

# Save Horizontal picture
# for a vertical stacking it is simple: use vstack
imgs_comb = np.vstack( (np.asarray( i.resize(min_shape) ) for i in imgs ) )
imgs_comb = Image.fromarray( imgs_comb)
imgs_comb.save( 'testing.jpg' )

print "Completed"
