# Automatic setup for ssh keys on VMs 
# This script requires sshpass proogram in order to work


if [ "$3" == "" ] 
then
    echo "Usage : ./sshKeys.sh <proxy_ip> <port> <root_password>"
    exit
fi

# Enabling root login with password (we need it to copy ssh key to remote machine) 

parola=$3


sshpass -p $parola ssh -t -p $2 tw@$1 "echo "$parola" | sudo -S sed -i 's/.*PermitRootLogin.*/PermitRootLogin yes/' /etc/ssh/sshd_config"
sshpass -p $parola ssh -t -p $2 tw@$1 "echo "$parola" | sudo -S service sshd restart"


# Stergem eventualele chei generate anterior

rm -f ~/.ssh/id_rsa.pub
rm -f ~/.ssh/id_rsa


# Generam perechea de chei ssh si o punem pe cea publica pe masina la care vrem sa ne conectam 

ssh-keygen -N "" -f ~/.ssh/id_rsa -t rsa
sshpass -p $parola ssh-copy-id -p $2 root@$1


