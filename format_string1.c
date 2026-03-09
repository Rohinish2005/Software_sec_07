/* improved_format_string.c */
#include <stdio.h>

// IMPROVEMENT 1: Use 'const' to enforce that this function reads-only
void secure_logger(const char *user_input) {
    
    // IMPROVEMENT 2: Null pointer check
    if (user_input == NULL) {
        printf("Error: No input provided.\n");
        return;
    }

    // Secure: Explicitly using "%s" prevents format string interpretation
    printf("Log entry: %s\n", user_input); 
}

int main() {
    // Even if the input contains "%x", it is treated as plain text
    secure_logger("Hello World %x %x");
    return 0;
}
