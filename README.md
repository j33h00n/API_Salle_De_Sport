API_Salle_De_Sport
========================
API de gestion de salles de sports d'une franchise avec ses structures.

Prérequis
------------

  * PHP 8.1.0 ou superieur;
  * Composer 2.4.3 ou superieur;
  * Symfony 6.x ou superieur;
  * et [toutes les dépendances de base pour le bon fonctionnement de Symfony](http://symfony.com/doc/current/reference/requirements.html).

Installation
------------
- Téléchargez le git
lien : https://github.com/j33h00n/API_Salle_De_Sport.git

- Executez la fixture pour charger des données fictives pour effectuer les différentes manipulation du site.

```bash
$ php bin/console doctrine:fixtures:load

```

> **NOTE**
>Attention:
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

structures@orangebleue.com

En vous souhaitant bonne navigation...