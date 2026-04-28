import hashlib
def generate_hash(data):
    return hashlib.sha256(data.encode()).hexdigest()


def verify_integrity(original_hash, new_hash):
    if original_hash == new_hash:
        print("Data Integrity Verified,no tampering is done")
    else:
        print("Integrity Check Failed,the data has been tampered/altered")

text1 = input("Enter original text: ")
hash1 = generate_hash(text1)
print("Original SHA-256 Hash:", hash1)

text2 = input("Re-enter the text to verify integrity: ")
hash2 = generate_hash(text2)
print("New SHA-256 Hash:", hash2)
