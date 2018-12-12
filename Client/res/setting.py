########################################################
#         Fichier de configuration du boitier          #
########################################################
import os
import logging

#-------------------------------------------
#           informations boitier           #
#-------------------------------------------
NUMERO_VERSION="1.0"
LOG_CONSOLE_LEVEL = logging.DEBUG
LOG_FILE_LEVEL = logging.DEBUG
READER_TTY = "tmr:///dev/ttyUSB0"
READER_REGION = "EU3"
READER_PLAN = "GEN2"

#-------------------------------------------
#        Gestion du protocole MQTT         #
#-------------------------------------------
BROKER_ADDRESS = "192.168.4.1"
BROKER_PORT = 1883
MQTT_NAME = "boitier1"
MQTT_PASSWORD = "boitier"
MQTT_SUBSCRIPTIONS = ("boitiers/boitier1")


#-------------------------------------------
#     Informations relative au client      #
#-------------------------------------------
CLIENT_NAME = "BOITIER1"
CLIENT_LOCATION="HALL"
CLIENT_IP="192.168.4.16"


#-------------------------------------------
#                  PATH                    #
#-------------------------------------------
# directories
PATH_PROJET_SRC_DIR = os.getcwd()
PATH_PROJET = PATH_PROJET_SRC_DIR.replace("src", "")
PATH_PROJET_RES_DIR = os.path.join(PATH_PROJET, "res")
PATH_PROJET_LOG_DIR = os.path.join(PATH_PROJET, "log")

# files
PATH_CMDS_FILE = os.path.join(PATH_PROJET_RES_DIR, "commands.json")
PATH_LOG_FILE = os.path.join(PATH_PROJET_LOG_DIR, "log.txt")
