# coding: utf-8

import sys
sys.path.append("../log")
from logger import Logger, LogLevel
import mysql.connector
from datetime import datetime
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
            
    def getPatientFromTag(self, tag):
        
        try:
            request = "SELECT * FROM Patient WHERE Patient.idTag = (SELECT id FROM Tag WHERE Tag.number = \"{}\")".format(tag)
            res = self.processRequest(request)
        except Exception as e_get_patient_from_tag:
            raise IOError(e_get_patient_from_tag)
        return res
    
    def getBorneFromName(self, name):
        
        try:
            request = "SELECT * FROM Borne WHERE Borne.name = \"{}\"".format(name)
            res = self.processRequest(request)
            
        except Exception as e_get_patient_from_tag:
            raise IOError(e_get_patient_from_tag)
        return res
    
    def pushPosition(self, idPatient, borne):
        
        now = datetime.utcnow()
        
        tmp = self.getBorneFromName(borne)
        print(tmp[0][0])
        if(len(tmp) > 0):
            # recuparation de l id  de la borne
            idBorne = tmp[0][0]
        else:
            Logger.log(LogLevel.ERROR, "BDD MANAGER", "No matching borne for {}".format(borne))
            raise ValueError("No matching borne for {}".format(borne))
        
        try:
            
            request = "INSERT INTO Position (idPatient, idBorne) VALUES ({}, {})".format(idPatient, idBorne)
            self.processInsertion(request)
        
        except Exception as e_push_position:
            raise IOError(e_push_position)
            
    def processInsertion(self, request):

        try:
            self.cursor.execute(request)
            self.conn.commit()

        except Exception as e_query_bdd:
            Logger.log(LogLevel.ERROR, "BDD MANAGER", "Couldn't not process insertion \"{}\" : {}".format(request, e_query_bdd))
    
    def destroy():
        self.cursor.close()
        self.con.close()
