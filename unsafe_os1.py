
import subprocess
import shutil
import re  

def ping_host_secure(hostname):
    
    if not re.match(r"^[a-zA-Z0-9.-]+$", hostname):
        print(f"Security Alert: Invalid hostname format '{hostname}'")
        return

    print(f"Pinging {hostname}...")
    
    if not shutil.which("ping"):
        print("Error: Ping utility not found.")
        return

    try:
        result = subprocess.run(
            ["ping", "-c", "1", hostname], 
            check=True,
            timeout=5,
            capture_output=True,
            text=True
        )
        print("Ping successful!")
        
    except subprocess.TimeoutExpired:
        print("Error: Ping timed out.")
    except subprocess.CalledProcessError:
        print("Ping failed (Host unreachable).")
    except Exception as e:
        print(f"An error occurred: {e}")

# This will now be blocked by the Regex check
ping_host_secure("google.com; echo 'SYSTEM COMPROMISED'")

# This will work
ping_host_secure("google.com")
