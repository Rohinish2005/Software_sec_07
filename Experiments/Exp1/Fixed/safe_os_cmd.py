import os

filename = input("Enter a filename: ")

if os.path.isfile(filename):
    with open(filename, "r", encoding="utf-8", errors="ignore") as f:
        print(f.read())
else:
    print("Invalid file")
