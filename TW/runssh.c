#include <stdio.h>
#include <stdlib.h>
#include <string.h>


int main(int argc, char** argv){



    char command[200];
    sprintf(command, "ssh -p %s root@84.117.124.45 %s > output.txt" , argv[1], argv[2]);
    //sprintf(command, "pwd >output.txt");
    system(command);
    return 0;

}
