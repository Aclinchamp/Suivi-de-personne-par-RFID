import mercury
import time

def main():
    reader = mercury.Reader("tmr:///dev/ttyUSB0")
    print(reader.get_antennas())
    reader.set_region("EU3")
    reader.set_read_plan([1], "GEN2")
    while(True):
        tags = reader.read(1000)
        
        if(len(tags) == 0):
            print("\n --- NO TAG FOUND DURING CAPTURE --- \n")
        else:
            print("\n Capture : ")
            process_capture(tags)
            print("\n")
        time.sleep(1)
        
def process_capture(tags):
    #print(tags)
    for tag in tags:
        print("[+] new tag :")
        
        affiche("Epc", tag.epc)
        affiche("Count", tag.read_count)
        affiche("Rssi", tag.rssi)
        affiche("epc mem", tag.epc_mem_data)
        affiche("Tid mem", tag.tid_mem_data)
        affiche("User mem", tag.user_mem_dat
        affiche("Mem", tag.epc_mem_data)
            
def affiche(des, chaine):
    
    print("\t[{}] {}".format(des, chaine))
    
if __name__ == "__main__":
    main()

