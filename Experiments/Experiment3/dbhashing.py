import hashlib
username = input(" Create Username:")
stored_hash = hashlib.sha256(input("Create Password :").encode()).hexdigest()
 
print("\n User registered successfully \n")

login_user= input ("Enter username:")
login_hash = hashlib.sha256(input("Enter Password:").encode()).hexdigest()

if (username == login_user and stored_hash == login_hash):
     
    print("Login successfully")

else:

    print("Login failed")

