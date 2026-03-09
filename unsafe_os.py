import os

def ping_host_vulnerable(hostname):
    print(f"Pinging {hostname}...")
    
    
    command = "ping -c 1 " + hostname
    
    os.system(command)


ping_host_vulnerable("google.com; echo 'SYSTEM COMPROMISED'")
