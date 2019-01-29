#coding: utf-8
from command import Command, CommandTypes
from collections import OrderedDict
import sys
import parser
from interfaceMqtt import InterfaceMqtt as intfMqtt
from logger import Logger, LogLevel
from interfaceReader import InterfaceTagReader
import time
from queue import Queue
sys.path.append("../res")
import setting

def getQueryAnswer(cmd):

    if(cmd.getName == "etat"):
        return ""

def main():

    fifo_mqtt2core = Queue()
    fifo_core2mqtt = Queue()
    fifo_reader2core = Queue()


    print("[Core] Create logger")
    logger = Logger()

    Logger.log(LogLevel.DEBUG, "CORE", "Create interfaces threads")
    mqtt = intfMqtt(fifo_mqtt2core, fifo_core2mqtt)
    
    reader = InterfaceTagReader(fifo_reader2core)
    Logger.log(LogLevel.DEBUG, "CORE", "starting mqtt Interfaces")
    mqtt.start()
    Logger.log(LogLevel.DEBUG, "CORE", "starting RFID Interfaces")
    reader.start()

    while(mqtt.connected == False):
        time.sleep(0.25)
    
    Logger.log(LogLevel.INFO, "CORE", "Core is now ready")
    while(True):
		
        # check if new tag dectection is wainting
        if(not fifo_reader2core.empty()):
            Logger.log(LogLevel.DEBUG, "CORE", "New tag from reader")
            newcmd = fifo_reader2core.get()
            fifo_core2mqtt.put(newcmd)

        # check if new mqtt message is wainting
        elif(not fifo_mqtt2core.empty():
            Logger.log(LogLevel.DEBUG, "CORE", "New mqtt message")
            newcmd = fifo_mqtt2core.get()

            # if message is a query message
            if(newcmd.getType() == CommandTypes.GET):
               answer = newcmd.generateAck();
               answer.setPayload(getQueryAnswer(cmd))
               fifo_core2mqtt.put(answer)

            # if message is an ack message
            elif(newcmd.getType() == CommandTypes.ACK):
                # not implemented
                pass

            # message is a push message
            else:
                # not implemented
                pass



            
    
    mqtt.stop()
    reader.stop()

    Logger.log(LogLevel.DEBUG, "CORE", "Stop was sended")
    
    
    mqtt.join()
    reader.join()
    
    Logger.log(LogLevel.INFO, "CORE", "Core is down")
    
if __name__ == "__main__":
    main()
