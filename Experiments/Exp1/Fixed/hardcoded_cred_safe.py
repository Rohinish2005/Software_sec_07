import os
import mysql.connector

def connect_db():
    conn = mysql.connector.connect(
        host="localhost",
        user=os.getenv("DB_USER"),
        password=os.getenv("DB_PASS"),
        database="students"
    )
    return conn
