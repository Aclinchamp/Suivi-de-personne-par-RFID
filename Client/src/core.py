#coding: utf-8
from command import Command, CommandTypes
from collections import OrderedDict
import sys
import parser
from interfaceMqtt import InterfaceMqtt as intfMqtt
from logger import Logger, LogLevel
from interfaceReader import InterfaceTagReader
import time

sys.path.append("../res")
import setting
def main():
    '''
    cmd = Command("GESTION", CmdTypes.PUSH, "position", "EB1234567890")
    cmd.printCmd()

    jsonCmd = cmd.getJsonCmd()
    print("\n" + jsonCmd + "\n")

    newCmd = Command("", "", "", "")
    newCmd.setCmdFromJson(jsonCmd)
    newCmd.printCmd()

    ack = newCmd.generateAck()
    print(ack)
    '''
    '''
    print("projet : {}".format(setting.PATH_PROJET))
    print("res : {}".format(setting.PATH_PROJET_RES_DIR))
    print("src : {}".format(setting.PATH_PROJET_SRC_DIR))
    print("file : {}".format(setting.PATH_CMDS_FILE))

    '''

    '''
    parser.getCommandFromJson()
    '''
    print("[Core] Create logger")
    logger = Logger()

    Logger.log(LogLevel.DEBUG, "CORE", "Create interfaces threads")
    intf_mqtt = intfMqtt()
    reader = InterfaceTagReader()
    Logger.log(LogLevel.DEBUG, "CORE", "starting")
    intf_mqtt.start()
    reader.start()

    Logger.log(LogLevel.DEBUG, "CORE", "wait 60 second")
    for i in range(30):
        if(i%5 == 0):
            Logger.log(LogLevel.DEBUG, "CORE", "Remaining time : {}".format(30 - i))
        time.sleep(1)

    intf_mqtt.stop()
    reader.stop()

    Logger.log(LogLevel.DEBUG, "CORE", "Stop was sended")
    
    
    intf_mqtt.join()
    reader.join()
    
    Logger.log(LogLevel.INFO, "CORE", "Core is down")
    
if __name__ == "__main__":
    main()
