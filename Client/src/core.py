#coding: utf-8
from command import Command, CmdTypes
from collections import OrderedDict
def main():

    cmd = Command("GESTION", CmdTypes.PUSH, "position", "EB1234567890")
    cmd.printCmd()

    jsonCmd = cmd.getJsonCmd()
    print("\n" + jsonCmd + "\n")

    newCmd = Command("", "", "", "")
    newCmd.setCmdFromJson(jsonCmd)
    newCmd.printCmd()

    ack = newCmd.generateAck()
    print(ack)

if __name__ == "__main__":
    main()