#coding: utf-8

import sys
sys.path.append("../res")
import setting
import logging
from logging.handlers import RotatingFileHandler

class Logger(object):
 
    def __init__(self):
        # création de l'objet logger qui va nous servir à écrire dans les logs
        self.logger = logging.getLogger()
        # on met le niveau du logger à DEBUG, comme ça il écrit tout
        self.logger.setLevel(logging.DEBUG)
        
        # création d'un formateur qui va ajouter le temps, le niveau
        # de chaque message quand on écrira un message dans le log
        formatter = logging.Formatter('%(asctime)s :: %(levelname)s :: %(message)s')
        # création d'un handler qui va rediriger une écriture du log vers
        # un fichier en mode 'append', avec 1 backup et une taille max de 1Mo
        file_handler = RotatingFileHandler(setting.PATH_LOG_FILE, 'a', 1000000000, 1)
        # on lui met le niveau sur DEBUG, on lui dit qu'il doit utiliser le formateur
        # créé précédement et on ajoute ce handler au logger
        file_handler.setLevel(setting.LOG_FILE_LEVEL)
        file_handler.setFormatter(formatter)
        self.logger.addHandler(file_handler)
        
        # création d'un second handler qui va rediriger chaque écriture de log
        # sur la console
        stream_handler = logging.StreamHandler()
        stream_handler.setLevel(setting.LOG_CONSOLE_LEVEL)
        self.logger.addHandler(stream_handler)

    @staticmethod
    def log(level, component, message):
        
        if(level == LogLevel.DEBUG):
            logging.debug("[{}] {}".format(component, message))
        elif(level == LogLevel.INFO):
            logging.info("[{}] {}".format(component, message))
        elif(level == LogLevel.WARNING):
            logging.warning("[{}] {}".format(component, message))
        elif(level == LogLevel.ERROR):
            logging.error("[{}] {}".format(component, message))
        elif(level == LogLevel.CRITICAL):
            logging.critical("[{}] {}".format(component, message))



class LogLevel(object):

    DEBUG = logging.DEBUG
    INFO = logging.INFO
    WARNING = logging.WARNING
    ERROR = logging.ERROR
    CRITICAL = logging.CRITICAL