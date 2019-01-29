#coding: utf-8
from command import Command, CommandTypes
from collections import OrderedDict
import sys
import parser
from interfaceMqtt import InterfaceMqtt as intfMqtt
from logger import Logger, LogLevel
import time
from bddManager import BddManager
from sys import argv

from queue import Queue

sys.path.append("../res")
import setting

def main(lieu):
   
    print("[Core] Create logger")
    logger = Logger()

    Logger.log(LogLevel.DEBUG, "CORE", "Create BDD")

    try:
        bdd = BddManager(setting.SQL_HOST, setting.SQL_DATABASE, setting.SQL_USER, setting.SQL_PASSWORD)
    
        
        patientId = bdd.getPatientFromTag("E20040057305016225401321")
        if(len(patientId) == 0):
            print("KOKOK")
        print("id : {}\n".format(patientId[0][0]))
        response = bdd.getLastPosition(patientId[0][0])
        if(lieu == response[0][0]):
            print("Il sort de la pièce")
        else:
            print("Il entre dans la pièce")
        #print(response[0][0])
        #bdd.pushPosition(response[0][0], "boitier2")
            
            
        Logger.log(LogLevel.INFO, "CORE", "Core is down")
    
    except Exception as e_bdd:
        printf("ERROR on BDD : {}".format(e_bdd))
    
if __name__ == "__main__":
    main(argv[1])

