# Projet 5 : agrégateur de sites web grâce aux flux RSS
Ceci est le cinquième et dernier projet de ma formation "Développeuse web junior". 

## Pourquoi ce projet ?
L'intérêt est de s'abonner aux flux RSS des sites qui nous intéressent (blogs, sites d'informations...) afin d'être informé des nouvelles parutions, pour une utilisation de loisirs ou de veille.

## Comment ça marche ?

### Du point de vue de l'utilisateur·ice
En créant un compte, l'utilisateur peut ajouter des sites internets et les classer selon différentes catégories.
Une fois connecté, il pourra choisir de visualiser tous les flux qu'il a enregistrés, seulement ceux d'une catégorie, ou un seul spécifique.

### Du point de vue de développeur·se
Partie backend en PHP avec le framework Laravel :
* création d'un compte pour l'utilisateur en base de données
* stockage des flux en base de données
* récupération des nouveaux articles dans les flux RSS et "conversion" XML en JSON

Partie frontend en JavaScript avec le framework Vue.JS :
* AJAX avec bibliothèque Axios
* affichage des flux mis en forme

----------------------------------------------

# Project 5 : RSS reader
This is the fifth and last project of my training of "Junior Web Developper".

## Why this project ?
The interest of receiving RSS feed is to be kept informed of new articles, whether it is for hobbies or watch.

## How does it work ?

### From the user point of view
The user creates an account, which enables him/her  to add RSS feeds sorting them by catgeories. When logged, he or she can display all the feeds, only the ones in a specific category, or only one feed.

### From the developper point of view
Backend in PHP with Laravel framework:
* creation of user account in database
* feeds storage in database
* parsing new articles of the feeds and "conversion" XML to JSON

Frontend in JavaScript with Vue.JS framework:
* AJAX with Axios library
* display of the RSS feeds
