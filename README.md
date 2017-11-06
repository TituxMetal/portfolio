[![SensioLabsInsight](https://insight.sensiolabs.com/projects/81e71dbf-2503-4e40-8522-cddc97f4f04e/big.png)](https://insight.sensiolabs.com/projects/81e71dbf-2503-4e40-8522-cddc97f4f04e)

# Portfolio

Ce projet est une synthèse de ce que j'ai appris lors de ma formation de Développeur/Intégrateur Web Junior à la 3WAcademy de Strasbourg et de mon évolution après cette formation.

Il servira également à valider mes compétences pour l'obtention du diplôme officiel délivré par la 3WAcademy.

# Les langages

J'ai utilisé les cinq principaux langages vues lors de la formation, à savoir :

  + Html 5
  + Css 3
  + Javascript ES6
  + Php 7.0
  + Sql

## Les évolutions

Depuis la fin de la formation j'ai évolué dans la façon de construire un projet et j'ai mis à jour mes connaissances.
Je suis passé, notamment de Php 5.6 à Php 7.0 (version stable dans les dépôts Debian 9 Stretch) et de javascript ES5 vers ES6.

# Les outils

J'ai choisi d'utiliser Git pour la gestion de version du projet, Gulp pour la compilation et la minification des fichiers Sass et js, composer pour la gestion des dépendances Php et Npm pour la gestion des dépendances Javascript.

J'utilise le micro framework Silex pour la structure et le routing, ainsi que Doctrine DBAL pour l'abstraction de la base de données. Pour les vues, j'ai opté pour le moteur de template Twig.

J'ai également voulu versionner l'évolution du schema de la base de donnée n utilisant Phinx, fini les fichiers dump.sql qui se baladent partout.

# Le deploiement

## Prérequis

### Php 7.0
```
apt install php7.0-fpm php7.0-xml
```

### Composer
```
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && chmod 0755 /usr/local/bin/composer
```

### MariaDb
```
apt install mariadb-server php7.0-mysql
```

## Installation

### Clonez ce dépôt dans le répertoire de votre choix :
```
git clone git@github.com:TituxMetal/portfolio.git &&
cd portfolio
```

### Installez les dépendances avec composer
```
composer install
```

### Copiez le fichier .env.dist
```
cp .env.dist .env
```

### Créez une base de données vide.

### Modifiez le fichier .env avec les bonnes informations.

### Executez les migrations
```
php vendor/bin/phinx migrate
```

### Ajoutez les données prédéfinie
```
php vendor/bin/phinx seed:run
```

### Démarez le serveur php
```
php -S localhost:8000 -t public
```
