import hashlib
import getpass


password1 = getpass.getpass("Enter password: ")
password2 = getpass.getpass("Enter password: ")

md5_hash1 = hashlib.md5(password1.encode()).hexdigest()
md5_hash2 = hashlib.md5(password2.encode()).hexdigest()
print("MD5 Hash:", md5_hash1)
print("MD5 Hash:", md5_hash2)

sha256_hash1 = hashlib.sha256(password1.encode()).hexdigest()
sha256_hash2 = hashlib.sha256(password2.encode()).hexdigest()
print("SHA-256 Hash:", sha256_hash1)
print("SHA-256 Hash:", sha256_hash2)
if (md5_hash1 == md5_hash2):
       print("md5_hash password Sucessful")
else:
   print("Unsucessful")
if ( sha256_hash1 == sha256_hash2):
        print("sha_256 password Sucessful")
else:
   print("Unsucessful")
