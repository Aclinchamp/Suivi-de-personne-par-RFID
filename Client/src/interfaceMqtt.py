import sys
sys.path.append("../res")
import  paho.mqtt.client as mqtt
import threading
import setting
from command import Command, CommandTypes
import time
from logger import Logger, LogLevel


class InterfaceMqtt(threading.Thread):

    def __init__(self):
        threading.Thread.__init__(self)

        self.keepRunning = True
        self.connected = False
        

    def run(self):

         # setting up mqtt connection
        try:
            self.mqttClient = mqtt.Client(setting.MQTT_NAME)
            self.mqttClient.username_pw_set(setting.MQTT_NAME, setting.MQTT_PASSWORD)
            self.mqttClient.on_connect = self.on_connect
            self.mqttClient.on_message = self.on_message
            self.mqttClient.on_publish = self.on_publish

            returnCode = self.mqttClient.connect(setting.BROKER_ADDRESS, setting.BROKER_PORT)

            self.mqttClient.loop_start()
            
            # waiting for connexion             
            while(self.connected == False):
                Logger.log(LogLevel.DEBUG, "INTF MQTT", "try to connect to {}@{}:{}".format(setting.MQTT_NAME, setting.BROKER_ADDRESS, setting.BROKER_PORT))
                time.sleep(1)

            self.mqttClient.subscribe(setting.MQTT_SUBSCRIPTIONS)

            while(self.keepRunning):
                # all networkd events are processing into callback 
                Logger.log(LogLevel.DEBUG, "INTF MQTT", "Try to send : {}".format("Ceci est un message"))
                self.mqttClient.publish("gestion", "Ceci est un message")
                time.sleep(5)

            Logger.log(LogLevel.DEBUG, "INTF MQTT", "Thread was stopped\n")
            self.mqttClient.disconnect()
            self.mqttClient.loop_stop()

        except IOError as e_io_mqtt_init:
            Logger.log(LogLevel.ERROR, "INTF MQTT", "couldn't initialize mqtt connexion : {}".format(e_mqtt_init))
            raise IOError("[INTF MQTT] couldn't initialize mqtt connexion : {}".format(e_mqtt_init))
        except Exception as e_mqtt_init:
            Logger.log(LogLevel.ERROR, "INTF MQTT", "couldn't initialise mqtt connexion : {}".format(e_mqtt_init)) 


    def on_connect(self, client, userdata, flags, returnCode):
        if(returnCode != 0):
            if(returnCode == 1):
                raise IOError("Connection was refused - incorrect portocol version")
            elif(returnCode == 1):
                raise IOError("Connection was refused - incorrect client identifier")
            elif(returnCode == 1):
                raise IOError("Connection was refused - server is unavailable")
            elif(returnCode == 1):
                raise IOError("Connection was refused - bad username or password")
            elif(returnCode == 1):
                raise IOError("Connection was refused - not authorised")
            else:
                raise IOError("Couldn't etablish connection for unknown reasons")
        else:
            self.connected = True
            Logger.log(LogLevel.DEBUG, "INTF MQTT", "Connection etablished on {}@{}:{}".format(setting.MQTT_NAME, setting.BROKER_ADDRESS, setting.BROKER_PORT))
        

    def on_message(self, client, userdata, msg):
        Logger.log(LogLevel.DEBUG, "INTF MQTT", "Received : {} {}".format(msg.payload, client))

        """
        recvMsg = Command()
        recvMsg.setCmdFromJson(msg.payload.loads())
        Logger.log(LogLevel.DEBUG, "INTF MQTT", "Received message from ")
        recvMsg.printCmd()
        """

    def on_publish(self, client, userdata, mid):
        Logger.log(LogLevel.DEBUG, "INTF MQTT", "Sended")


    def stop(self):
        self.keepRunning = False

