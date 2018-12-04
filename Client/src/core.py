#coding: utf-8
from command import Command, CmdTypes
from collections import OrderedDict
import sys
import parser

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

    parser.getCommandFromJson()

if __name__ == "__main__":
    main()