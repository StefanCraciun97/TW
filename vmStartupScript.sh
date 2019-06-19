# Scriptul asta se ruleaza ori de cate ori nu merge conexiunea la masina virtuala (probabil a picat tunelul SSH)
# Reseteaza tunelul SSH si agentul
# Trebuie dat ca ragument la linia de comanda portul de pe proxy prin care vrem sa ne putem conecta la masina virtuala (11000 + id-ul masinii in baza de date)


 
if [ "$1" == "" ]
then
    echo "Usage: ./vmStartupScript.sh <port>"
    exit
fi
 
port=$1
parola="13iunie"
 
pkill -f "ssh -Nf"
sshpass -p $parola ssh -o StrictHostKeyChecking=no -Nf -R 10000:localhost:15000 tw@84.117.124.45
 
pkill -f "./vmAgent.out"
./vmAgent.out &
