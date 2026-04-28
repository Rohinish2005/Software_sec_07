#include <stdio.h>
#include <string.h>

void vulnerable_function() {
    char buffer[10];

    printf("Enter your name: ");
    gets(buffer);

    printf("Hello %s\n", buffer);
}

int main() {
    vulnerable_function();
    return 0;
}
