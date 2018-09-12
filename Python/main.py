#!/usr/bin/python
from Crypto.Cipher import AES
from sense_hat import SenseHat
import base64                       # Get Base64 encryption
import os                           # Using simple python scripts
import datetime                     # Date Time script to get the date and convert
import requests                     # import to send requetst to server
import threading                    # import to make more threads
import RPi.GPIO as GPIO             # import RPi.GPIO module  
import time                         # Import time to make the delays
import Adafruit_DHT                 # Call the DHT Lib

################# Settings #################
plantID = 2                         # Plant ID 
motorPin = 26                       # GPIO of the motorPin USE 26!! NEVER USE GPIO 2!!!!!!!
sensorPin = 21                      # GPIO of the moisture sensor
ledStripPin = 19
############################################
salt = "K8q44XTKsQer"               # Zorg dat de salt altijd even lang is! (12 Chars)
iv   = "NzUXWTXMAw3HjEi3"           # Zorg dat de salt altijd even lang is! (16 Chars)
block_size  = 128                   # Block grootte voor AES (Altijd 128)
apilink = "https://windeswiet.nl/" # API link. Altijd inclusief '/' !
serverLink = "http://janvetq144.144.axc.nl/"
############## End settings ################ 

sense = SenseHat()					# Name sense hat
sense.clear()						# Clear sense Hat before using it
GPIO.setmode(GPIO.BCM)              # Define the BCM headers          
GPIO.setup(motorPin, GPIO.OUT)      # Define motor Pin Mode                 
GPIO.output(motorPin, 0)            # Set motorpin low to be sure
GPIO.setup(ledStripPin, GPIO.OUT)   # Define motor Pin Mode                 
GPIO.output(ledStripPin, 0)         # Set motorpin low to be sure
GPIO.setup(sensorPin, GPIO.IN)      # Define sensor Pin Mode
GPIO.setwarnings(False)

def runPump():
    GPIO.output(motorPin, 1)        # Run the Pump for 1 second
    print("Motor is on")			# Just debug info
    time.sleep(3)                   # Sleep the second  
    GPIO.output(motorPin, 0)        # Turn of the pump
    print("Motor is off")			# Just debug info
    GPIO.output(ledStripPin, 1)     # Run the Pump for 1 second
    print("Led is on")				# Just debug info
    time.sleep(3)                   # Sleep the second  
    GPIO.output(ledStripPin, 0)     # Turn of the pump
    print("Led is off")				# Just debug info

def uploadData():
    humidity, temperature = Adafruit_DHT.read_retry(Adafruit_DHT.DHT22, 4)
    humidity = format(humidity)											# Convert to data that we can use
    temperature = format(temperature)									# Convert to data that we can use
    link = serverLink + "api.php?call=time"
    response = requests.get(link)										# Receive response for sync
    currentTime = response.text											# Use the response as var for time

    link = serverLink + "api.php?call=date"
    respone = requests.get(link)										# Receive response for sync
    currentDate = respone.text											# Use the response as var for date

    PADDING = '{'														# Adding padding because of the UTF coding
    pad = lambda s: s + (block_size - len(s) % block_size) * PADDING 	# Define the pad with Lambda
    EncodeAES = lambda c, s: base64.b64encode(c.encrypt(pad(s)))		# Encode the data
    secret = salt + currentTime											# Create the salt with the timestamp
    cipher= AES.new(key=secret,mode=AES.MODE_CBC,IV=iv)					# Create the Cipher key with IV
    encoded = EncodeAES(cipher, currentDate)							# Data to encode with the Cipher and variable date
    sendtoken = encoded.decode('utf-8')									# Convert to usable UTF-8 Data because we are sending an request
    sendtoken = sendtoken.replace('/','')								# Replace / because we use laravel. Encoded data might be using /
    #link = serverLink + "api.php?token=%s&temp=%s&humidity=%s" % (sendtoken, temperature, humidity)
    #link = apilink + "public/api/insert/%s/%s/%s/%s" % (sendtoken, plantID, temperature, humidity)
    result = requests.get(link)

    print(link) 														# Print the exact link for debugging 
    print (result.text) 												# Read the response for debugging

def setSmiley(type):
    if type == "sad" :
        sense.clear()									
        sense.set_pixel(2, 2, (255, 0, 0))	# Setting Sense Pixel for sad smiley
        sense.set_pixel(5, 2, (255, 0, 0))	# Setting Sense Pixel for sad smiley
        sense.set_pixel(2, 5, (255, 0, 0))	# Setting Sense Pixel for sad smiley
        sense.set_pixel(4, 5, (255, 0, 0))	# Setting Sense Pixel for sad smiley
        sense.set_pixel(5, 5, (255, 0, 0))	# Setting Sense Pixel for sad smiley
        sense.set_pixel(5, 5, (255, 0, 0))	# Setting Sense Pixel for sad smiley
        sense.set_pixel(1, 6, (255, 0, 0))	# Setting Sense Pixel for sad smiley
        sense.set_pixel(6, 6, (255, 0, 0))	# Setting Sense Pixel for sad smiley
        sense.set_pixel(3, 5, (255, 0, 0))	# Setting Sense Pixel for sad smiley
        print("I'm Sad")					# Debugging information
    else:
        sense.clear()
        sense.set_pixel(2, 2, (0, 255, 0))	# Setting Sense Pixel for happy smiley
        sense.set_pixel(5, 2, (0, 255, 0))	# Setting Sense Pixel for happy smiley
        sense.set_pixel(1, 5, (0, 255, 0))	# Setting Sense Pixel for happy smiley
        sense.set_pixel(2, 6, (0, 255, 0))	# Setting Sense Pixel for happy smiley
        sense.set_pixel(3, 6, (0, 255, 0))	# Setting Sense Pixel for happy smiley
        sense.set_pixel(4, 6, (0, 255, 0))	# Setting Sense Pixel for happy smiley
        sense.set_pixel(6, 5, (0, 255, 0))	# Setting Sense Pixel for happy smiley
        sense.set_pixel(5, 6, (0, 255, 0))	# Setting Sense Pixel for happy smiley
        print("I'm Happy!")					# Debugging information


def checkSetLights():
    link = apilink + "api.php?call=date"	# Call the API to check the status
    respone = requests.get(link)			# Receiving response
    activeLed = respone.text				# Response to variable
    if activeLed == True:
    	print("Led on!")					# Turn the led strip on
    	GPIO.output(ledStripPin, 1)     	# Enable the led strip
    else:
    	print("Led off!")					# Turn the led strip off
    	GPIO.output(ledStripPin, 0)     	# Disable the led strip
    	
def checkManualPump():
    link = apilink + "api.php?call=date"	# Call the API to check the status
    respone = requests.get(link)			# Receiving response
    manualPump = respone.text				# Response to variable
    if manualPump == True:
    	print("Pump manual on!")			# Turn the pump on
    	runPump()							# Call the pump function
    else:
    	print("Pump manual off!")			# Don't turn the pump on

try:  
    while True:
        if GPIO.input(sensorPin):
            print("No need!")       	# No water needed Plant is happy
            setSmiley("happy")			# Call the set smiley function
        else:
            print("Need water")     	# Water needed. Plant is sad.
            setSmiley("sad")			# Call the set smiley function
            runPump()               	# Run the Pump 
        uploadData()					# Call Function to upload data to database
        checkManualPump()				# Call function to check if pump must be turned on
        checkSetLights()				# Call function to check if lights must be turned on
        time.sleep(5)               	# Delay to slow down the while
        
except KeyboardInterrupt:        
    GPIO.setmode(GPIO.BCM)              # Define the BCM headers          
    GPIO.setup(motorPin, GPIO.OUT)      # Define motor Pin Mode    
    GPIO.cleanup()                      # Clean the pins in this script
    sense.clear()
finally:
    GPIO.setmode(GPIO.BCM)              # Define the BCM headers          
    GPIO.setup(motorPin, GPIO.OUT)      # Define motor Pin Mode    
    GPIO.cleanup()                      # Clean the pins in this script
    sense.clear()
 

