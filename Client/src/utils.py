#coding: utf-8
from logger import Logger, LogLevel

class CoreState(object):

    def __init__(self):
        self.state = CoreSateLevel.OK

    @staticmethod
    def setState(self, state):
        self.state = state
    
    @staticmethod
    def getState(self):
        return self.state
    
    @staticmethod
    def LogState(self, level):
        Logger.log(LogLevel.DEBUG, "CORE_STATE", "Current state is {}".format(self.state))
        
        

class CoreSateLevel(object):
    
    OK = "OK"
    ERR_1  = "Logger default"
    ERR_2  = "Reader problem : couldn't find reader"
    ERR_4  = "Reader problem : ..."
    ERR_5  = "ADU"
    ERR_6  = ""
    ERR_7  = ""
    ERR_8  = ""
    ERR_9  = ""
    ERR_10 = ""
    ERR_11 = ""
    ERR_12 = ""
    ERR_13 = ""
    ERR_14 = ""
    ERR_15 = ""
    ERR_16 = ""
    ERR_17 = ""
    ERR_18 = ""
    ERR_19 = ""
    ERR_20 = ""
