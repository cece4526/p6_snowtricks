# p6_snowtricks

This repository contains the source code for my Symfony project from the Snotricks site. This is a web application for sharing snowboard tricks.

## Table des matières

- [Prérequis](#prérequis)
- [Installation](#installation)
- [Utilisation](#utilisation)
- [Structure du Projet](#structure-du-projet)
- [Contributions](#contributions)
- [License](#license)

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre système :

- PHP [8.2.0]
- Composer [2.5.8]
- Symfony CLI [5.5.6]
- [Autres dépendances nécessaires]

## Installation

1. Clonez ce dépôt :

   ```bash
   git clone https://github.com/cece4526/p6_snowtricks.git
   cd mon-projet-symfony

2. Installez les dépendances du projet en utilisant Composer :

    '''bash
    composer install

3. Copiez le fichier .env et configurez les variables d'environnement nécessaires, comme la base de données.

4. Créez la base de données et appliquez les migrations :

    '''bash

    php bin/console doctrine:database:create
    php bin/console doctrine:migrations:migrate

    then import the .SQl export of the database from the exportBDD folder

5. Démarrez le serveur de développement Symfony :

    '''bash
    symfony serve

6. Accédez à l'application dans votre navigateur à l'adresse http://localhost:8000.

## Utilisation
    
    Once the database is set up and the symfony server is launched, all you have to do is connect with admin@snowtrick.fr and password Adminsnowtrick2023. then remember to change the password or create your own user and give him admin rights in the database

## Structure du Projet


mon-projet-symfony/
    ├── bin/
    ├── config/
    ├── Diagram_UML
    ├── exportBDD
    ├── public/
    |   ├── assets
    |       ├── js
    |       ├── styles
    |   ├── images
    |       ├──  tricks
    |            ├── mini
    ├── src/
    │   ├── Controller/
    |   ├── DataFixtures
    │   ├── Entity/
    |   |   ├──  Trait
    │   ├── Form
    |   ├── Repository
    |   ├── Security
    |   ├── Service
    ├── templates/
    ├── tests/
    ├── translations/
    ├── var/
    ├── vendor/
## Contributions
Contributions are welcome! If you would like to contribute to this project, please follow these steps:

Fork this repository.
Create a branch for your feature or bug fix (git checkout -b new-feature).
Commit your changes (git commit -m 'Add new feature').
Push the branch to your fork (git push origin new-feature).
Open a Pull Request to this repository.
