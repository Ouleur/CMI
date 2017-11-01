cmi_dev
=======

A Symfony project created on October 31, 2017, 12:34 am.

#Commande 

Création d'une base de donnée 
php bin/console doctrine:database:create

Création et mise à des tables selon les Entity 
php bin/console doctrine:schema:update --force

Liste des routes definies
php bin/console debug:router



Requette qui fonctionne déja
============================

#Ajout d'une carte
 
 |------------|---------------------------------------------------------|
 | Verbe HTTP |						URL                                 |
 |------------|---------------------------------------------------------|
 |  GET       |           http://127.0.0.1:8000/cartes                  |
 