#coding: utf-8
import sys
sys.path.append("../res")
import json
import setting
from collections import OrderedDict

def getCommandFromJson():
    commands = OrderedDict()
    cmds = OrderedDict()
    document = setting.PATH_CMDS_FILE

    # read the json file 
    with open(document) as f:
        tmp = json.load(f)

    # due to the json file architecture, we need to convert a list of dict 
    # #into a dict of commands
    for element in tmp["commands"]:
        commands["{}".format(element["cmdName"])] = element
    
    return commands