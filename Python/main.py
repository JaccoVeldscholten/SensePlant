#!/usr/bin/python
from sense_hat import SenseHat
from Crypto.Cipher import AES
from threading import Thread
import threading
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
motorPin = 26                        # GPIO of the motorPin USE 26!! NEVER USE GPIO 2!!!!!!!
sensorPin = 21                      # GPIO of the moisture sensor
############################################
salt = "K8q44XTKsQer"               # Zorg dat de salt altijd even lang is! (12 Chars)
iv   = "NzUXWTXMAw3HjEi3"           # Zorg dat de salt altijd even lang is! (16 Chars)
block_size  = 128                   # Block grootte voor AES (Altijd 128)
apilink = "https://windeswiet.nl/" # API link. Altijd inclusief '/' !
serverLink = "http://janvetq144.144.axc.nl/"
############## End settings ################ 

sense = SenseHat()
sense.clear()
GPIO.setmode(GPIO.BCM)              # Define the BCM headers          
GPIO.setup(motorPin, GPIO.OUT)      # Define motor Pin Mode                 
GPIO.output(motorPin, 0)            # Set motorpin low to be sure
GPIO.setup(sensorPin, GPIO.IN)      # Define sensor Pin Mode
GPIO.setwarnings(False)

def runPump():
    GPIO.output(motorPin, 1)        # Run the Pump for 1 second
    print("Motor is on")
    time.sleep(3)                   # Sleep the second  
    GPIO.output(motorPin, 0)        # Turn of the pump
    print("Motor is off")

def uploadData():
    humidity, temperature = Adafruit_DHT.read_retry(Adafruit_DHT.DHT22, 4)
    humidity = round(humidity, 2)
    temperature = round(temperature, 2)
    link = serverLink + "api.php?call=time"
    response = requests.get(link)
    currentTime = response.text

    link = serverLink + "api.php?call=date"
    respone = requests.get(link)
    currentDate = respone.text

    PADDING = '{'
    pad = lambda s: s + (block_size - len(s) % block_size) * PADDING
    EncodeAES = lambda c, s: base64.b64encode(c.encrypt(pad(s)))
    secret = salt + currentTime
    cipher= AES.new(key=secret,mode=AES.MODE_CBC,IV=iv)
    encoded = EncodeAES(cipher, currentDate)
    sendtoken = encoded.decode('utf-8')
    sendtoken = sendtoken.replace('/','')
    link = serverLink + "api.php?token=%s&temp=%s&humidity=%s" % (sendtoken, temperature, humidity)
    #link = apilink + "public/api/insert/%s/%s/%s/%s" % (sendtoken, plantID, temperature, humidity)
    result = requests.get(link)

    print(link) #just for debug :3
    print (result.text) # OK = Data updated.

def setSmiley(type):
    if type == "sad" :
        sense.clear()
        sense.set_pixel(2, 2, (255, 0, 0))
        sense.set_pixel(5, 2, (255, 0, 0))
        sense.set_pixel(2, 5, (255, 0, 0))
        sense.set_pixel(4, 5, (255, 0, 0))
        sense.set_pixel(5, 5, (255, 0, 0))
        sense.set_pixel(5, 5, (255, 0, 0))
        sense.set_pixel(1, 6, (255, 0, 0))
        sense.set_pixel(6, 6, (255, 0, 0))
        sense.set_pixel(3, 5, (255, 0, 0))
        print("I'm Sad")
    else:
        sense.clear()
        sense.set_pixel(2, 2, (0, 255, 0))
        sense.set_pixel(5, 2, (0, 255, 0))
        sense.set_pixel(1, 5, (0, 255, 0))
        sense.set_pixel(2, 6, (0, 255, 0))
        sense.set_pixel(3, 6, (0, 255, 0))
        sense.set_pixel(4, 6, (0, 255, 0))
        sense.set_pixel(6, 5, (0, 255, 0))
        sense.set_pixel(5, 6, (0, 255, 0))
        print("I'm Happy!")


def checkSetLights():
    link = apilink + "api.php?call=checkLed"
    respone = requests.get(link)
    ledStatusManual = respone.text
    if ledStatusManual == True:
    	print("Led on!")
    else:
    	print("Led off!")

def checkPumpManual():
    link = apilink + "api.php?call=checkPump"
    respone = requests.get(link)
    pumpStatusManual = respone.text
    if pumpStatusManual == True:
        print("Pump on!")
        runPump()

try:  
    while True:
        if GPIO.input(sensorPin):
            print("No need!")       # No water needed Plant is happy
            setSmiley("happy")
        else:
            print("Need water")     # Water needed. Plant is sad.
            setSmiley("sad")
            runPump()               # Run the Pump 
        Thread(target = checkPumpManual).start()
        Thread(target = checkSetLights).start()
        Thread(target = uploadData).start()
        time.sleep(5)               # Delay to slow down the while
        
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
 

