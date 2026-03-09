
#include <stdio.h>
#include <string.h>
#include <ctype.h>

#define BUFFER_SIZE 16

int main(void) {
    char name[BUFFER_SIZE];
    
    printf("Enter your name: ");

    // IMPROVEMENT 1: Use fgets instead of scanf
    // fgets reads up to BUFFER_SIZE - 1 characters, guaranteeing null-termination.
    if (fgets(name, sizeof(name), stdin) != NULL) {
        
        // Remove the newline character that fgets saves
        name[strcspn(name, "\n")] = 0;

        // IMPROVEMENT 2: Input Sanitization
        // Verify the input contains only letters or spaces
        for (int i = 0; i < strlen(name); i++) {
            if (!isalpha(name[i]) && !isspace(name[i])) {
                printf("Error: Invalid characters in name.\n");
                return 1;
            }
        }

        printf("Hello %s\n", name);
    } else {
        printf("Error reading input.\n");
    }

    return 0;
}
