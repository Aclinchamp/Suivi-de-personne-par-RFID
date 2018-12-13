#coding: utf-8
from command import Command, CommandTypes
from collections import OrderedDict
import sys
import parser
from interfaceMqtt import InterfaceMqtt as intfMqtt
from logger import Logger, LogLevel
import time
from bddManager import BddManager

from queue import Queue

sys.path.append("../res")
import setting

def main():
   
    print("[Core] Create logger")
    logger = Logger()

    Logger.log(LogLevel.DEBUG, "CORE", "Create BDD")
    bdd = BddManager(setting.SQL_HOST, setting.SQL_DATABASE, setting.SQL_USER, setting.SQL_PASSWORD)
    
    response = bdd.processRequest("SELECT * FROM Patient LEFT JOIN Tag ON Patient.idTag = Tag.id")
    
    print(response[0][0])
    bdd.pushPosition(response[0][0], "boitier1")
        
        
    Logger.log(LogLevel.INFO, "CORE", "Core is down")
    
if __name__ == "__main__":
    main()

