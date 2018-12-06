#coding : utf-8
import sys
sys.path.append("../res")
import setting
import time
import mercury
import threading
from logger import Logger, LogLevel

class InterfaceTagReader(threading.Thread):

    def __init__(self):

        try:
            threading.Thread.__init__(self)
            
            self.keepRunning = True
            self.TagReader = mercury.Reader(setting.READER_TTY)

            self.TagReader.set_region(setting.READER_REGION)
            self.TagReader.set_read_plan([1], setting.READER_PLAN)

            Logger.log(LogLevel.DEBUG, "INTF RFID", "Interface initialised on tty : {}".format(setting.READER_TTY))
            
        except Exception as e_init_intfReader:
            Logger.log(LogLevel.ERROR, "INTF RFID", "couldn't initialise RFID connexion : {}".format(e_init_intfReader)) 

    def run(self):

            self.TagReader.start_reading(self.onRfidTag, 10, 1000)
            
            while(self.keepRunning == True):
                pass
              
           Logger.log(LogLevel.DEBUG, "INTF RFID", "Thread was stopped")  
            

    def onRfidTag(self,  tag):
        Logger.log(LogLevel.INFO, "INTF RFID", "NEW TAG : {} {} {}".format(tag.epc, tag.read_count, tag.rssi))

    def stop(self):
        self.TagReader.stop_reading()
        self.keepRunning = False
