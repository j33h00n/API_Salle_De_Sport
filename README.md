API_Salle_De_Sport
========================
API de gestion de salles de sports d'une franchise avec ses structures.

Prérequis
------------

  * PHP 8.1.0 ou superieur;
  * Composer 2.4.3 ou superieur;
  * Symfony 6.x ou superieur;
  * et [toutes les dépendances de base pour le bon fonctionnement de Symfony](http://symfony.com/doc/current/reference/requirements.html).

> **NOTE**
>
>Developpé et testé avec XAMPP v3.3.0
>BDD : MariaDB 10.4.25
>Apache : Apache 2.4.54
>PHP : PHP 8.1.10
>

Installation
------------
- Téléchargez le git
lien : https://github.com/j33h00n/API_Salle_De_Sport.git


Editez le fichier .env et ajustez les infos pour connecter votre base de donnée :

```bash
DATABASE_URL="mysql://root:@127.0.0.1:3306/sport?serverVersion=mariadb-10.4.25&charset=utf8mb4"

```

Preparez une base de donnée sous le nom : sport


```bash
$ php bin/console make migration:migrate

```
> **NOTE**
>
>La nom de la base de donnée est nommée : sport
>

- Executez la fixture pour charger des données fictives pour effectuer les différentes manipulation du site.

```bash
$ php bin/console doctrine:fixtures:load

```

> **NOTE**
>
>Il peut arriver qu'une erreur de chargement de fixtures car un generateur aléatoire de selection peut
>parfois tomber sur la meme entrée, il suffit de relancer le LOAD de la fixture et normalement cela
>devrait finir le processus de création.
>
>Il sera necessaire d'avoir un intercepteur de mail de type MAILHOG ou MAILDEV
>Le mailer interne n'a pas été configuré pour cette simulation.


Utilisation
-----------

Une fois que vous avez lancé votre serveur Web local.

Lancez un navigateur a cette adresse:

http://localhost ou http://127.0.0.1

Cela dépendra de la configuration de votre poste.

3 comptes oont été crée pour constater les regles de sécurité
en plus des comptes d'utilisateurs aléatoires créer avec php faker

- Compte ADMIN:

admin@admin.com / admin

- Compte Franchises:

franchises@orangebleue.com / bonjour1

- Compte Structures:

structures@orangebleue.com / bonjour1

En vous souhaitant bonne navigation...