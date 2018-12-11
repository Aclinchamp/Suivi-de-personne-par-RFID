#coding: utf8
import mercury
import json
import time
import paho.mqtt as mqtt

def main():

    print("Configuration de la liaison MQTT")
    client = mqtt.Client("boitier1")
    client.username_pw_set("boitier1", "boitier")
    client.connect("192.168.4.1", 1883)
    time.sleep(1)

    print("Récuperation de l'objet reader\n")
    reader = mercury.Reader("tmr:///dev/ttyUSB0")

    print("Configuration du reader")
    reader.set_region("EU3")
    reader.set_read_plan([1], "GEN2")

    print("passage en acquisition")
    while(True):
        tags = reader.read(1000)
        
        if(len(tags) == 0):
            print("\n --- NO TAG FOUND DURING CAPTURE --- \n")
        else:
            jsonPaquet = createJsonPaquet(tags)
            client.publish("gestion", jsonPaquet)
            print("SENDED : \n")
            print(jsonPaquet)

        time.sleep(1)


def createJsonPaquet():
    
    paquet = '{"\
            "Source":"boitier1",\
            "Destination":"gest",\
            "type":"push",\
            "command":"position",\
            "payload":"{}",\
            "}'.format(tag.epc)

    return paquet

if __name__ == "__main__":
    main()


'''
on utilise l'instruction dumps pour jsoniser
et l'instruction loads pour dejisoniser

'''