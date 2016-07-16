Il vous est possible de voir la quantité de mémoire et CPU utilisés par tout vos conteneurs via la commande suivante :

$ docker stats $(docker ps -q)

Vous pouvez également supprimer tous les conteneurs et/ou toutes les images d'un coup :

$ docker rm $(docker ps -a -q)
$ docker rmi $(docker images -q)

rentrer dans un container en cours d'execution
$ docker exec -it [container_id] bash

sudo echo '127.0.0.1 localurl.dev' | sudo tee -a /etc/hosts