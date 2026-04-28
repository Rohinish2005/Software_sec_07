#include <stdio.h>
#include <string.h>

void safe_function() {
    char buffer[10];

    printf("Enter your name: ");
    fgets(buffer, sizeof(buffer), stdin);

    printf("Hello %s\n", buffer);
}

int main() {
    safe_function();
    return 0;
}
