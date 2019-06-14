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



int main(int argc, char **argv){



    int clientSocket=socket(AF_INET, SOCK_STREAM, 0);


    char *buffer=(char*) calloc(3000, sizeof(char));   //remember to free
    char smallBuffer[120];
    char comanda[200];
    int port = atoi(argv[1]);

    struct sockaddr_in serverAddress;

    serverAddress.sin_family=AF_INET;
    serverAddress.sin_addr.s_addr=inet_addr("84.117.124.45");
    
    serverAddress.sin_port=htons(port);
    memset(serverAddress.sin_zero,0,sizeof(serverAddress.sin_zero));

    printf("Trying to connect to %s on port %d...\n", inet_ntoa(serverAddress.sin_addr), ntohs(serverAddress.sin_port));

    
    if(connect(clientSocket, (struct sockaddr *)&serverAddress, sizeof(serverAddress))<0){
        perror("Eroare la connect");
        return errno;
    }
    

    printf("Connected to server at %s on port %d.\n", inet_ntoa(serverAddress.sin_addr), ntohs(serverAddress.sin_port));


    short lungime=0;


    //while(1){

        //clearing previous result string from buffer
        memset(buffer,0,3000);

        //printf(">");
        //fgets(comanda,200,stdin);
        strcpy(comanda,argv[2]);
        //comanda[strlen(comanda)-1]=0; // deleting '\n' at the end
        sendMessage(clientSocket,comanda,200);


        FILE *f=fopen("out.txt", "wb");



        while(1){
            lungime=recvMessage(clientSocket, smallBuffer, 110);
            if(lungime==0)
                break;
            //fwrite(buffer, sizeof(char), lungime, fisier);

            
            //strcat(buffer, smallBuffer);
            fwrite(smallBuffer,sizeof(char),lungime,f);
        }



        //printf("%s\n", buffer);

        
        fclose(f);
        
    //}


    free(buffer);


    return 0;
}
