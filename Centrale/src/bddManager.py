# coding: utf-8

import sys
sys.path.append("../log")
from logger import Logger, LogLevel
import mysql.connector


class BddManager(object):

    def __init__(self, host, database, user, password):

        self.host = host
        self.user = user
        self.database = database
        self.password = password

        self.conn = object
        self.cursor = object

        try:
            self.connect()
        except Exception as e_connect_bdd:
            Logger.log(LogLevel.ERROR, "BDD MANAGER", "Couldn\'t connect to the bdd \"{}\" : {}".format(self.database, e_connect_bdd))
            raise ConnectionError("Could not connect to bdd")
    def connect(self):
        
        try:
            self.conn = mysql.connector.connect(host=self.host, user=self.user, passwd=self.password, db=self.database)

            # check if connected
            if(self.conn.is_connected()):
                self.cursor = self.conn.cursor()
                Logger.log(LogLevel.INFO, "BDD MANAGER", "Connected to BDD as {}@{}".format(self.user, self.host))
            else:
                raise IOError("Could not connect to bdd for unknown reason")
        except Exception as e_connect_bdd:
            raise IOError("Could not connect to bdd : {}".format(e_connect_bdd))

    def processRequest(self, request):
        
        response = object

        try:
            self.cursor.execute(request)
            response = self.cursor.fetchall()

            return response

        except Exception as e_query_bdd:
            Logger.log(LogLevel.ERROR, "BDD MANAGER", "Couldn't not process request \"{}\" : {}".format(request, e_query_bdd))
    
    def destroy():
        self.cursor.close()
        self.con.close()
