#!/usr/bin/python
from Crypto.Cipher import AES
import base64                       # Get Base64 encryption
import os                           # Using simple python scripts
import datetime                     # Date Time script to get the date and convert
import requests                     # import to send requetst to server
import threading                    # import to make more threads
import RPi.GPIO as GPIO             # import RPi.GPIO module  
import time                         # Import time to make the delays
import Adafruit_DHT                 # Call the DHT Lib


################# Settings ################# 
motorPin = 2                        # GPIO of the motorPin
sensorPin = 21                      # GPIO of the moisture sensor
############################################
salt = "K8q44XTKsQer"               # Zorg dat de salt altijd even lang is! (12 Chars)
iv   = "NzUXWTXMAw3HjEi3"           # Zorg dat de salt altijd even lang is! (16 Chars)
block_size  = 128                   # Block grootte voor AES (Altijd 128)
apilink = "http://janvetq144.144.axc.nl/" # API link. Altijd inclusief '/' !
############## End settings ################ 

humidity, temperature = Adafruit_DHT.read_retry(Adafruit_DHT.DHT22, 4)
GPIO.setmode(GPIO.BCM)              # Define the BCM headers          
GPIO.setup(motorPin, GPIO.OUT)      # Define motor Pin Mode                 
GPIO.output(motorPin, 0)            # Set motorpin low to be sure
GPIO.setup(sensorPin, GPIO.IN)      # Define sensor Pin Mode

def runPump():
    GPIO.output(motorPin, 1)        # Run the Pump for 1 second         
    time.sleep(1)                   # Sleep the second  
    GPIO.output(motorPin, 0)        # Turn of the pump

def uploadData():
    humidity = round(humidity, 2)
    temperature = round(temperature, 2)
    link = apilink + "api.php?call=time"
    response = requests.get(link)
    currentTime = response.text

    link = apilink + "api.php?call=date"
    respone = requests.get(link)
    currentDate = respone.text

    PADDING = '{'
    pad = lambda s: s + (block_size - len(s) % block_size) * PADDING
    EncodeAES = lambda c, s: base64.b64encode(c.encrypt(pad(s)))
    secret = salt + currentTime
    cipher= AES.new(key=secret,mode=AES.MODE_CBC,IV=iv)
    encoded = EncodeAES(cipher, currentDate)
    sendtoken = encoded.decode('utf-8')
    link = apilink + "api.php?token=%s&temp=%s&humidity=humidity" % (sendtoken, temperature, humidity)
    result = requests.get(link)

    print(link) #just for debug :3
    print (result.text) # OK = Data updated.

try:  
    while True:
        if GPIO.input(sensorPin):
            print("No need!")       # No water needed Plant is happy
        else:
            print("Need water")     # Water needed. Plant is sad.
            runPump()               # Run the Pump 
        uploadData()
        time.sleep(5)               # Delay to slow down the while
        
except KeyboardInterrupt:        
    GPIO.output(motorPin, 0)        # Turn off the motor   
    GPIO.cleanup()                  # Clean the pins in this script
 
