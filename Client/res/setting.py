########################################################
#         Fichier de configuration du boitier          #
########################################################
import os
#-------------------------------------------
#        Gestion du protocole MQTT         #
#-------------------------------------------
BROKER_ADDRESS = "192.168.4.1"
BROKER_PORT = "1883"
MQTT_NAME = "boitier1"
MQTT_PASSWORD = "boitier"

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

# files
PATH_CMDS_FILE = os.path.join(PATH_PROJET_RES_DIR, "commands.json")
