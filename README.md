cmi_dev
=======

A Symfony project created on October 31, 2017, 12:34 am.

## Commande 

Création d'une base de donnée 
`php bin/console doctrine:database:create`

Création et mise à des tables selon les Entity 
`php bin/console doctrine:schema:update --force`

Liste des routes definies
`php bin/console debug:router`



Requettes qui fonctionnent déja
===============================
L'utilisation de l'outil [Postman](https://www.getpostman.com/) facilitera les testes
## Ajout d'une carte
 

 | Verbe HTTP |			URL                  	|     Utilité           |          Paramettres         |
 |------------|---------------------------------|-----------------------|------------------------------|
 |   GET      | http://127.0.0.1:8000/cartes  	|  Toute la liste       |								 |
 |   GET      | http://127.0.0.1:8000/cartes/1	|     Une ligne         |id 							 |
 |   POST     | http://127.0.0.1:8000/cartes    | Ajout une ligne       |carteNumero,carteCode		 |
 |  DELETE    | http://127.0.0.1:8000/cartes/1	|   Suppression         |id 							 |
 |	 PUT      | http://127.0.0.1:8000/cartes/6  |  Modificaton Conplete |carteNumero *\n carteDateDelivrance[year] 
 carteDateDelivrance[month] 
 carteDateDelivrance[day]
 carteCode