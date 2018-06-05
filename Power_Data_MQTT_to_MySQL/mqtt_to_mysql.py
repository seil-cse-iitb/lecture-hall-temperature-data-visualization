import paho.mqtt.client as mqtt
import paho.mqtt
import time
from datetime import datetime
from MySQLdb import *
import sys
from db import insert_to_db

MQTT_HOST="10.129.23.41"
MQTT_PORT=1883

MQTT_TOPIC="data/kresit/sch/40"
room_name=""

def get_mqtt_msg():

    def on_connect(client, userdata, flags, rc):
        client.subscribe(MQTT_TOPIC+room_name)
        print "Subscibed to "+MQTT_TOPIC+room_name

    def on_message(client, userdata, msg):
      print datetime.now().strftime('%H:%M:%S  : ')+ "Recived "+  msg.payload
      message=msg.payload.split(",")
      print message

      srl=float(message[0])
      TS=float(message[1])
      VA=float(message[2])
      W=float(message[3])
      VAR=float(message[4])
      PF=float(message[5])
      VLL=float(message[6])
      VLN=float(message[7])
      A=float(message[8])
      F=float(message[9])
      VA1=float(message[10])
      W1=float(message[11])
      VAR1=float(message[12])
      PF1=float(message[13])
      V12=float(message[14])
      V1=float(message[15])
      A1=float(message[16])
      VA2=float(message[17])
      W2=float(message[18])
      VAR2=float(message[19])
      PF2=float(message[20])
      V23=float(message[21])
      V2=float(message[22])
      A2=float(message[23])
      VA3=float(message[24])
      W3=float(message[25])
      VAR3=float(message[26])
      PF3=float(message[27])
      V31=float(message[28])
      V3=float(message[29])
      A3=float(message[30])
      FwdVAh=float(message[31])
      FwdWh=float(message[32])
      FwdVARhR=float(message[33])
      FwdVARhC=float(message[34])

      insert_to_db(FwdWh,PF1,PF2,PF3,A3,V23,VLL,VLN,TS,A1,V1,V2,A2,PF,VA1,VA2,VA3,A,VA,FwdVAh,F,W,VAR,V31,VAR1,VAR2,VAR3,V12,FwdVARhR,srl,V3,W1,W2,W3,FwdVARhC)

    print "pa"
    client = mqtt.Client("LH Power Data")
    client.on_connect = on_connect
    client.on_message = on_message
    client.connect(MQTT_HOST, MQTT_PORT, 60)
    client.loop_forever()

if __name__=="__main__":
    get_mqtt_msg()