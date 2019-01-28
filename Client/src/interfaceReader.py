#coding : utf-8
import sys
sys.path.append("../res")
import setting
import time
import mercury
import threading
from logger import Logger, LogLevel
from command import Command, CommandTypes
from utils import CoreState, CoreSateLevel


class InterfaceTagReader(threading.Thread):

    def __init__(self, fifo):

        try:
            threading.Thread.__init__(self)
            
            self.keepRunning = True

            try:
                self.TagReader = mercury.Reader(setting.READER_TTY)
            except Exception as e_uncorrect_tty:
                Logger.log(LogLevel.DEBUG, "INTF RFID", "TTY {} is not reachable".format(setting.READER_TTY))
                CoreState.setState(CoreSateLevel.ERR_2)


            self.TagReader.set_region(setting.READER_REGION)
            self.TagReader.set_read_plan([1], setting.READER_PLAN)

            self.fifo = fifo

            Logger.log(LogLevel.DEBUG, "INTF RFID", "Interface initialised on tty : {}".format(setting.READER_TTY))
            
        except Exception as e_init_intfReader:
            Logger.log(LogLevel.ERROR, "INTF RFID", "couldn't initialise RFID connexion : {}".format(e_init_intfReader)) 

    def run(self):

            self.TagReader.start_reading(self.onRfidTag, 10, 1000)
            
            while(self.keepRunning == True):
                pass
              
            Logger.log(LogLevel.DEBUG, "INTF RFID", "Thread was stopped")  
            

    def onRfidTag(self,  tag):

        cmd = Command("gestion", CommandTypes.PUSH, "position", "{}".format(tag.epc.decode("utf-8")))
        Logger.log(LogLevel.INFO, "INTF RFID", "NEW TAG : {} {} {}".format(tag.epc, tag.read_count, tag.rssi))
       	self.fifo.put(cmd)

    def stop(self):
        self.TagReader.stop_reading()
        self.keepRunning = False
        
        
