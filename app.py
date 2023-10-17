import tensorflow as tf
from tensorflow import keras
import numpy as np
import sys

# Load the pretrained model
model = keras.models.load_model('forest.h5')

# Load and preprocess the image
img = keras.preprocessing.image.load_img(sys.argv[1], target_size=(150, 150))
img_array = keras.preprocessing.image.img_to_array(img)
img_array = tf.expand_dims(img_array, 0) # Create a batch

# Make a prediction
predictions = model.predict(img_array)
score = predictions[0]

# The class with the highest probability is the predicted class
if score > 0.5:
    print("No fire detected")
else:
    print("Fire detected ")
