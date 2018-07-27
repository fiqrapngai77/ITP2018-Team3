import RPi.GPIO as GPIO         #GPIO Pin functions
import time                     #For sleep function
import numpy.core.multiarray
import numpy as ny
import os
import pygame
import pygame.camera
from pygame.locals import *

pygame.init()
pygame.camera.init()

GPIO.setmode(GPIO.BOARD)        #Use board pin numbers

## MOTOR PIN NUMBERS
MOTOR_1 = [7,11,13,15]

###----------------- START OF MOTOR_1 -----------------###

for pin in MOTOR_1:
    GPIO.setup(pin, GPIO.OUT)

def MOTOR_1_SETUP(a,b,c,d):
    GPIO.output(MOTOR_1[0], a)
    GPIO.output(MOTOR_1[1], b)
    GPIO.output(MOTOR_1[2], c)
    GPIO.output(MOTOR_1[3], d)
    time.sleep(0.002)

def MOTOR_1_RIGHT_TURN(deg):
    full_circle = 510.0
    degree = full_circle / 360 * deg
    MOTOR_1_SETUP(0,0,0,0)
    while degree > 0.0:
        MOTOR_1_SETUP(1,0,0,0)
        MOTOR_1_SETUP(1,1,0,0)
        MOTOR_1_SETUP(0,1,0,0)
        MOTOR_1_SETUP(0,1,1,0)
        MOTOR_1_SETUP(0,0,1,0)
        MOTOR_1_SETUP(0,0,1,1)
        MOTOR_1_SETUP(0,0,0,1)
        MOTOR_1_SETUP(1,0,0,1)
        degree -= 1

def MOTOR_1_LEFT_TURN(deg):
    full_circle = 510.0
    degree = full_circle / 360 * deg
    MOTOR_1_SETUP(0,0,0,0)
    while degree > 0.0:
        MOTOR_1_SETUP(1,0,0,1)
        MOTOR_1_SETUP(0,0,0,1)
        MOTOR_1_SETUP(0,0,1,1)
        MOTOR_1_SETUP(0,0,1,0)
        MOTOR_1_SETUP(0,1,1,0)
        MOTOR_1_SETUP(0,1,0,0)
        MOTOR_1_SETUP(1,1,0,0)
        MOTOR_1_SETUP(1,0,0,0)
        degree = degree - 1

###------------------ END OF MOTOR_1 ------------------###


MOTOR_1_SETUP(0,0,0,0)

#Get current directory
currdir = os.getcwd()

#To save directory
TO_SAVE_DIR = currdir + "/images/"

#check if folder exist or not, else create that empty directory
if not os.path.exists(TO_SAVE_DIR):
    os.makedirs(TO_SAVE_DIR)

delay = 2

##WIDTH = 1920
##HEIGHT = 1080

WIDTH = 640
HEIGHT = 480

camlist = pygame.camera.list_cameras()
webcam = pygame.camera.Camera(camlist[0])

    
def TURN(times):
        for x in range(times):
            while True:
                try:
                    webcam.start()
                    time.sleep(delay)
                    img = webcam.get_image()
                    filename = "images/image%d.jpg" % x
                    pygame.image.save(img, filename)
                    print("taking photo: [" + str(x+1)+"]")
                    webcam.stop()
                    time.sleep(delay)
                    break
                except:
                    print ("Resouce is busy")
                    time.sleep(delay)
            MOTOR_1_RIGHT_TURN(1440/times)
            MOTOR_1_SETUP(0,0,0,0)
            time.sleep(delay)
            if x == (times-1):
                time.sleep(delay)
                while True:
                    try:
                        webcam.start()
                        time.sleep(delay)
                        img = webcam.get_image()
                        filename = "images/image%d.jpg" % (x+1)
                        pygame.image.save(img, filename)
                        print("taking photo: [" + str(x+2)+"]")
                        webcam.stop()
                        time.sleep(delay)
                        break
                    except:
                        print ("Resouce is busy")
                        time.sleep(delay)
                time.sleep(delay)

                
PUSH_BUTTON_PIN = 16
GPIO.setup(PUSH_BUTTON_PIN, GPIO.IN, pull_up_down = GPIO.PUD_DOWN)

state = False

try:
    TURN(3)
    time.sleep(3)
    print("Moving back to orginal position")
    while True:
        if state == False:
            MOTOR_1_LEFT_TURN(1)
            MOTOR_1_SETUP(0,0,0,0)
            if GPIO.input(PUSH_BUTTON_PIN) == GPIO.HIGH:
                print("Button Pushed!")
                time.sleep(0.3)
                state = True
        if state == True:
            print("Stop moving")
            break
    time.sleep(2)
    
finally:
    GPIO.cleanup()
    print ("Done with taking photo")

















