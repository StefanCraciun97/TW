#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#include <unistd.h>  // for getcwd(), read(), write()

#include <sys/socket.h>
#include <netinet/in.h>  //for sockaddr_in struct
#include <errno.h>    // for detecting errors
#include <arpa/inet.h>   //for inet_addr and inet_ntoa functions






short recvMessage(int sock, char *buff, short max_cap){
    
	short len;

	if(-1==read(sock, &len, sizeof(short))){
		perror("Eroare la read");
		return -1;
	}

	if(len>max_cap)
		len=max_cap;

	if(-1==read(sock, buff, len)){
		perror("Eroare la read");
		return -1;
	}

    return len;

}


short sendMessage(int socket, char *buff, short len){

	short returnValue;

    if(-1==write(socket, &len, sizeof(short))){
		perror("Eroare la write");
		return -1;
	}
	
	
    returnValue=write(socket, buff, len);

	if(returnValue==-1){
		perror("Eroare la write");
		return -1;
	}

	return returnValue;

}




int main(){


    char comanda[200];
    char *buffer=(char*) calloc(3000, sizeof(char));   //remember to free

    int monitorSocket=socket(AF_INET, SOCK_STREAM, 0); // socket TCP pentru acceptarea clientilor
    int commSocket; // socketul de comunicare
    short lungime=0;


    struct sockaddr_in msAddress;
    struct sockaddr_in clientAddress;
    int clientAddressSize=sizeof(clientAddress);


    msAddress.sin_family=AF_INET;
    msAddress.sin_addr.s_addr=inet_addr("127.0.0.1");
    msAddress.sin_port=htons(15000);
    memset(msAddress.sin_zero,0,sizeof(msAddress.sin_zero));

    if(bind(monitorSocket, (struct sockaddr *)&msAddress,sizeof(msAddress))<0)   // fixam socketul pe portul specificat in msAddress
    {
        perror("Eroare la bind\n");
        return errno;
    }
    printf("Monitor socket at %s on port %d.\n", inet_ntoa(msAddress.sin_addr), ntohs(msAddress.sin_port));

    listen(monitorSocket,10);  // ascultam pentru conexiuni din partea clientilor
    printf("Listening...\n");



    //commSocket=accept(monitorSocket,(struct sockaddr *) &clientAddress, &clientAddressSize);
    //printf("Accepted connection from %s port %d.\n", inet_ntoa(clientAddress.sin_addr), ntohs(clientAddress.sin_port));
    //printf("Talking socket is on port %d.\n", inet_ntoa(clientAddress.sin_addr), ntohs(clientAddress.sin_port));


    while(1){

        commSocket=accept(monitorSocket,(struct sockaddr *) &clientAddress, &clientAddressSize);
        printf("Accepted connection from %s port %d.\n", inet_ntoa(clientAddress.sin_addr), ntohs(clientAddress.sin_port));


        recvMessage(commSocket,comanda,200);

        strcat(comanda, " > output.txt 2>&1");
        printf("%s\n", comanda);

        system(comanda);

        FILE *f = fopen("output.txt", "rb");

/*
        if(f==0){
            //printf("nu exista, trimit vorba la client\n");
            sendMessage(socket, "NO_FILE", 8); 
        
    }
        else
            sendMessage(socket,"OK", 3);
*/


        while(1){
            lungime=fread(buffer, sizeof(char), 100, f);
            sendMessage(commSocket, buffer, lungime);
            if(lungime==0)
                break;
        }


        fclose(f);

        close(commSocket);

    }

    free(buffer);
    return 0;
}
