########################################################
#         Fichier de configuration du boitier          #
########################################################
import os
import logging

#-------------------------------------------
#           information  boitier           #
#-------------------------------------------
NUMERO_VERSION="1.0"
LOG_CONSOLE_LEVEL = logging.DEBUG
LOG_FILE_LEVEL = logging.DEBUG

#-------------------------------------------
#        Gestion du protocole MQTT         #
#-------------------------------------------
BROKER_ADDRESS = "192.168.4.1"
BROKER_PORT = 1883
MQTT_NAME = "gestion"
MQTT_PASSWORD = "gestion"
MQTT_SUBSCRIPTIONS = ("gestion")


#-------------------------------------------
#      Information relative au client      #
#-------------------------------------------
CLIENT_NAME = "GESTION"
CLIENT_LOCATION="PLACARD"
CLIENT_IP="192.168.4.1"

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

#-------------------------------------------
#               SQL information             #
#-------------------------------------------
SQL_ADRESS = "192.168.4.1"
SQL_USER = "boitier"
SQL_PASSWORD = "hospital"
SQL_DATABASE = "BDD_HospitalTracking"
