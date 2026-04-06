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
password = getpass.getpass("Enter Password: ")


cursor.execute("SELECT password_hash FROM user WHERE username=%s", (username,))
result = cursor.fetchone()

if result:
    stored_hash = result[0]

    if bcrypt.checkpw(password.encode(), stored_hash):
        print("Login successful!")
    else:
        print("Incorrect password!")
else:
    print("User not found!")

conn.close()
