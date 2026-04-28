import hashlib
import os
username = input(" Create Username:")
salt = os.urandom(20)
initial_passwd = input("Create Password:")
stored_hash = hashlib.sha256(salt+initial_passwd.encode()).hexdigest()
print("\n User registered successfully \n")

login_user= input ("Enter username:")
login_password = input("Enter password:")
login_hash = hashlib.sha256(salt+login_password.encode()).hexdigest()

if (username == login_user and stored_hash == login_hash):
     
    print("Login successfully")

else:

    print("Login failed")
