import os
import secrets  # IMPROVEMENT 1: Needed for secure comparison
import sys

def check_admin_access_secure(password):
    # Retrieve password from environment
    stored_password = os.getenv("ADMIN_PASS")

    # IMPROVEMENT 2: Validate the environment setup
    if not stored_password:
        print("CRITICAL ERROR: 'ADMIN_PASS' is not set in the environment.")
        sys.exit(1) # Exit with error status

    # IMPROVEMENT 3: Prevent Timing Attacks
    # 'secrets.compare_digest' takes constant time regardless of match failure position.
    if secrets.compare_digest(password, stored_password):
        print("Access Granted.")
    else:
        print("Access Denied.")

if __name__ == "__main__":
    try:
        user_input = input("Enter admin password: ")
        check_admin_access_secure(user_input)
    except KeyboardInterrupt:
        print("\nOperation cancelled.")
