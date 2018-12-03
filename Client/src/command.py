#coding: utf8
import sys
sys.path.append("../res")
import setting
import json
from collections import OrderedDict

class Command(object):

    cmd = OrderedDict()

    def __init__(self, cmd_destination, cmd_type, cmd_name, cmd_payload):
        
        self.cmd["destination"] = cmd_destination
        self.cmd["source"] = setting.CLIENT_NAME
        self.cmd["type"] = cmd_type
        self.cmd["name"] = cmd_name
        self.cmd["payload"] = cmd_payload
        
    def getDestination(self):
        return self.cmd["destination"]

    def setDestination(self, destination):
        self.cmd["destination"] = destination

    def getSource(self):
        return self.cmd["source"]

    def setSource(self, source):
        self.cmd["source"] = source

    def getType(self):
        return self.cmd["type"]

    def setType(self, type):
        self.cmd["type"] = type

    def getName(self):
        return self.cmd["name"]

    def setName(self, name):
        self.cmd["name"] = name

    def getPayload(self):
        return self.cmd["payload"]
    
    def setPayload(self, payload):
        self.cmd["payload"] = payload

    def generateAck(self):
        cmd_ack = OrderedDict()
        cmd_ack["destination"] = self.cmd["source"]
        cmd_ack["source"] = self.cmd["destination"]
        cmd_ack["type"] = CmdTypes.ACK
        cmd_ack["name"] = self.cmd["name"]
        cmd_ack["payload"] = self.cmd["payload"]

        return json.dumps(cmd_ack)

    def getJsonCmd(self):
        return json.dumps(self.cmd)#, object_pairs_hook=OrderedDict)
    
    def setCmdFromJson(self, json_cmd):
        newCmd = json.loads(json_cmd, object_pairs_hook=OrderedDict)
        self.setDestination(newCmd["destination"])
        self.setSource(newCmd["source"])
        self.setType(newCmd["type"])
        self.setName(newCmd["name"])
        self.setPayload(newCmd["payload"])

    def printCmd(self):
        print("Cmd : ")
        print("\t Destination : {}".format(self.cmd["destination"]))
        print("\t Source : {}".format(self.cmd["source"]))
        print("\t Type : {}".format(self.cmd["type"]))
        print("\t Name : {}".format(self.cmd["name"]))
        print("\t Payload : {}".format(self.cmd["payload"]))

class CmdTypes(object):
    PUSH = "PUSH"
    GET = "GET"
    ACK = "ACK"

    def typeExists(cmdType):

        if(cmdType == self.PUSH or cmdType == self.GET or cmdType == self.ACK):
            return True
        else:
            return False
        