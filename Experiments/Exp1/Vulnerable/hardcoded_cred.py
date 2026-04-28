import mysql.connector

def connect_db():
    conn = mysql.connector.connect(
        host="localhost",
        user="admin",
        password="Admin@123",
        database="students"
    )
    return conn
