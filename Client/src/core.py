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

def main():

    fifo_mqtt2core = Queue()
    fifo_core2mqtt = Queue()
    fifo_reader2core = Queue()


    print("[Core] Create logger")
    logger = Logger()

    Logger.log(LogLevel.DEBUG, "CORE", "Create interfaces threads")
    mqtt = intfMqtt(fifo_mqtt2core, fifo_core2mqtt)
    
    reader = InterfaceTagReader(fifo_reader2core)
    Logger.log(LogLevel.DEBUG, "CORE", "starting")
    mqtt.start()
    reader.start()

    while(mqtt.connected == False):
        time.sleep(0.25)
    
   
    while(True):
		
        Logger.log(LogLevel.DEBUG, "CORE", "Waiting for tag")
        newcmd = fifo_reader2core.get()
        Logger.log(LogLevel.DEBUG, "CORE", "Sended to Mqtt")
        fifo_core2mqtt.put(newcmd)

    
    mqtt.stop()
    reader.stop()

    Logger.log(LogLevel.DEBUG, "CORE", "Stop was sended")
    
    
    mqtt.join()
    reader.join()
    
    Logger.log(LogLevel.INFO, "CORE", "Core is down")
    
if __name__ == "__main__":
    main()
