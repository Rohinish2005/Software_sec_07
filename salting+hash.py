import bcrypt
import mysql.connector
import getpass

conn = mysql.connector.connect(
    host="localhost",
    user="rohinish",
    password="Sharma@fbi",
    database="Rohinish"
)
cursor = conn.cursor()

username = input("Enter Username: ")

password1 = getpass.getpass("Enter Password: ")
password2 = getpass.getpass("Confirm Password: ")

if password1 != password2:
    print("Passwords do not match!")
    exit()
hashed = bcrypt.hashpw(password1.encode(), bcrypt.gensalt())

query = "INSERT INTO user (username, password_hash) VALUES (%s, %s)"
cursor.execute(query, (username, hashed))
conn.commit()

print("User registered successfully!")

conn.close()
