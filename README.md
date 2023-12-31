## VERIFICATION DES PRE-REQUIS

-   `symfony check:requirements`
-   `symfony`

## CREATION DU PROJET SYMFONY

-   `symfony new Youtube  --version="6.3.*" --webapp`
-   `symfony console make:controller`

Choose a name for your controller class (e.g. DeliciousKangarooController):

> DefaultController

created: src/Controller/DefaultController.php
created: templates/default/index.html.twig

Success!

Next: Open your new controller class and add some pages!

---

On pourra mettre le template généré a la racine des templates, le renommer home.html.twig et supprimer le dossier default.
Dans le DefaultController.php, on y ferra les modification indiquées dans la page et on le renommera HomeController.php.

---

## A ce stade, nous avons à "https://127.0.0.1:8000/" "Variable "controller_name" does not exist.".

## VISUEL TWIG

-   template base.html.twig:
-   On le récupere de Gaetan qu'on modifie pour notre site.
-   template base.html.twig:
-   On le modifie pour avoir les données de la page /home.
-   [getbootstrap.com](https://getbootstrap.com/) pour le block content de home.html.twig, la nav et le footer de base.html.twig.

## CONFIGURATION BDD

-   Copie/Colle .env en .env.local et on modifie le DATABASE_URL
-   `symfony console doctrine:database:create`

## CREATION DE ENTITEES

-   `symfony console make:user`

The name of the security user class (e.g. User) [User]:

>

Do you want to store user data in the database (via Doctrine)? (yes/no) [yes]:

>

Enter a property name that will be the unique "display" name for the user (e.g. email, username, uuid) [email]:

>

Will this app need to hash/check user passwords? Choose No if passwords are not needed or will be checked/hashed by some other system (e.g. a single sign-on server).

Does this app need to hash/check user passwords? (yes/no) [yes]:

>

created: src/Entity/User.php
created: src/Repository/UserRepository.php
updated: src/Entity/User.php
updated: config/packages/security.yaml

Success!

Next Steps:

-   Review your new App\Entity\User class.
-   Use make:entity to add more fields to your User entity and then run make:migration.
-   Create a way to authenticate! See https://symfony.com/doc/current/security.html

-   `symfony console make:entity Playlist`

created: src/Entity/Playlist.php
created: src/Repository/PlaylistRepository.php

Entity generated! Now let's add some fields!
You can always add more fields later manually or by re-running this command.

New property name (press <return> to stop adding fields):

> name

Field type (enter ? to see all types) [string]:

>

Field length [255]:

> 64

Can this field be null in the database (nullable) (yes/no) [no]:

>

updated: src/Entity/Playlist.php

Add another property? Enter the property name (or press <return> to stop adding fields):

>

Success!

Next: When you're ready, create a migration with symfony.exe console make:migration

-   `symfony console make:entity Video`

created: src/Entity/Video.php
created: src/Repository/VideoRepository.php

Entity generated! Now let's add some fields!
You can always add more fields later manually or by re-running this command.

New property name (press <return> to stop adding fields):

> title

Field type (enter ? to see all types) [string]:

>

Field length [255]:

> 128

Can this field be null in the database (nullable) (yes/no) [no]:

>

updated: src/Entity/Video.php

Add another property? Enter the property name (or press <return> to stop adding fields):

> description

Field type (enter ? to see all types) [string]:

>

Field length [255]:

>

Can this field be null in the database (nullable) (yes/no) [no]:

> yes

updated: src/Entity/Video.php

Add another property? Enter the property name (or press <return> to stop adding fields):

> url

Field type (enter ? to see all types) [string]:

> text

Can this field be null in the database (nullable) (yes/no) [no]:

>

updated: src/Entity/Video.php

Add another property? Enter the property name (or press <return> to stop adding fields):

> thumbnail

Field type (enter ? to see all types) [string]:

> text

Can this field be null in the database (nullable) (yes/no) [no]:

>

updated: src/Entity/Video.php

Add another property? Enter the property name (or press <return> to stop adding fields):

>

Success!

Next: When you're ready, create a migration with symfony.exe console make:migration

## RELATIONS ENTRE LES ENTITEES

-   `symfony console make:entity Tag`

created: src/Entity/Tag.php
created: src/Repository/TagRepository.php

Entity generated! Now let's add some fields!
You can always add more fields later manually or by re-running this command.

New property name (press <return> to stop adding fields):

> name

Field type (enter ? to see all types) [string]:

>

Field length [255]:

> 64

Can this field be null in the database (nullable) (yes/no) [no]:

>

updated: src/Entity/Tag.php

Add another property? Enter the property name (or press <return> to stop adding fields):

> description

Field type (enter ? to see all types) [string]:

> text

Can this field be null in the database (nullable) (yes/no) [no]:

> yes

updated: src/Entity/Tag.php

Add another property? Enter the property name (or press <return> to stop adding fields):

>

Success!

Next: When you're ready, create a migration with symfony.exe console make:migration

-   `symfony console make:entity Playlist`

Your entity already exists! So let's add some new fields!

New property name (press <return> to stop adding fields):

> user

Field type (enter ? to see all types) [string]:

> relation

What class should this entity be related to?:

> User

What type of relationship is this?

---

Type Description

---

ManyToOne Each Playlist relates to (has) one User.
Each User can relate to (can have) many Playlist objects.

OneToMany Each Playlist can relate to (can have) many User objects.
Each User relates to (has) one Playlist.

ManyToMany Each Playlist can relate to (can have) many User objects.
Each User can also relate to (can also have) many Playlist objects.

OneToOne Each Playlist relates to (has) exactly one User.
Each User also relates to (has) exactly one Playlist.

---

Relation type? [ManyToOne, OneToMany, ManyToMany, OneToOne]:

> ManyToOne

Is the Playlist.user property allowed to be null (nullable)? (yes/no) [yes]:

> no

Do you want to add a new property to User so that you can access/update Playlist objects from it - e.g. $user->getPlaylists()? (yes/no) [yes]:

> yes

A new property will also be added to the User class so that you can access the related Playlist objects from it.

New field name inside User [playlists]:

>

Do you want to activate orphanRemoval on your relationship?
A Playlist is "orphaned" when it is removed from its related User.
e.g. $user->removePlaylist($playlist)

NOTE: If a Playlist may _change_ from one User to another, answer "no".

Do you want to automatically delete orphaned App\Entity\Playlist objects (orphanRemoval)? (yes/no) [no]:

> yes

updated: src/Entity/Playlist.php
updated: src/Entity/User.php

Add another property? Enter the property name (or press <return> to stop adding fields):

>

Success!

Next: When you're ready, create a migration with symfony.exe console make:migration

-   `symfony console make:entity Video`

Your entity already exists! So let's add some new fields!

New property name (press <return> to stop adding fields):

> playlist

Field type (enter ? to see all types) [string]:

> ManyToMany

What class should this entity be related to?:

> Playlist

Do you want to add a new property to Playlist so that you can access/update Video objects from it - e.g. $playlist->getVideos()? (yes/no) [yes]:

>

A new property will also be added to the Playlist class so that you can access the related Video objects from it.

New field name inside Playlist [videos]:

>

updated: src/Entity/Video.php
updated: src/Entity/Playlist.php

Add another property? Enter the property name (or press <return> to stop adding fields):

> tag

Field type (enter ? to see all types) [string]:

> ManyToMany

What class should this entity be related to?:

> Tag

Do you want to add a new property to Tag so that you can access/update Video objects from it - e.g. $tag->getVideos()? (yes/no) [yes]:

>

A new property will also be added to the Tag class so that you can access the related Video objects from it.

New field name inside Tag [videos]:

>

updated: src/Entity/Video.php
updated: src/Entity/Tag.php

Add another property? Enter the property name (or press <return> to stop adding fields):

>

Success!

Next: When you're ready, create a migration with symfony.exe console make:migration

---

On réalise un contrôle visuel des fichiers, et des différentes générations.
Dans Video.php, erreur lors de la saisie: ligne 22 a modifier: #[ORM\Column(length: 255, nullable: true)] par #[ORM\Column(type: Types::TEXT, nullable: true)]

---

## CREATION DE TRAIT

-   Le fichier provient de Gaetan.
-   Cela permet, pour tout ce qui est ID et date de créations, d'éviter la répétition.
-   On mettra les bonnes notations à jour: #[ORM\Column
-   Dans Playlist.php, Tag.php, User.php et Video.php rajouter use EntityTimeTrait; Ne pas oublier d'importer la classe en haut.

## FAIRE LES MIGRATIONS

-   `symfony console make:migration`
-   `symfony.exe console doctrine:migrations:migrate`

## CREATION DE L'AUTH

-   `symfony console make:auth`

What style of authentication do you want? [Empty authenticator]:
[0] Empty authenticator
[1] Login form authenticator

> 1

The class name of the authenticator to create (e.g. AppCustomAuthenticator):

> LoginFormAuthenticator

Choose a name for the controller class (e.g. SecurityController) [SecurityController]:

>

Do you want to generate a '/logout' URL? (yes/no) [yes]:

>

created: src/Security/LoginFormAuthenticator.php
updated: config/packages/security.yaml
created: src/Controller/SecurityController.php
created: templates/security/login.html.twig

Success!

Next:

-   Customize your new authenticator.
-   Finish the redirect "TODO" in the App\Security\LoginFormAuthenticator::onAuthenticationSuccess() method.
-   Review & adapt the login template: templates/security/login.html.twig.

## QUAND JE CREE UN COMPTE

-   `symfony console make:registration`

Creating a registration form for App\Entity\User

Do you want to add a #[UniqueEntity] validation attribute to your User class to make sure duplicate accounts aren't created? (yes/no) [yes]:

>

Do you want to send an email to verify the user's email address after registration? (yes/no) [yes]:

> no

Do you want to automatically authenticate the user after registration? (yes/no) [yes]:

> yes

updated: src/Entity/User.php
created: src/Form/RegistrationFormType.php
created: src/Controller/RegistrationController.php
created: templates/registration/register.html.twig

Success!

Next:
Make any changes you need to the form, controller & template.

Then open your browser, go to "/register" and enjoy your new form!

---

## Réaliser les modifications suivantes:

-   Dans SecurityController.php, voir les commentaires du code.
-   Dans LoginFormAuthenticator.php, voir les commentaires du code.
-   Dans RegistrationController.php, voir les commentaires du code.
-   Dans les templates, mettre le register.html.twig, dans le dossier security et supprimer le dossier registration pour gain de place.
-   Il faut penser que dans RegistrationController.php à changer le fichier pointé en ligne 51 (voir commentaire)

## VISUELS TWIG PAGES CONNEXION ET INSCRIPTION

-   On se sert de home.html.twig pour completer login.html.twig et register.html.twig. On completera avec Bootstrap.
-   On met également les routes path pour register, login et logout dans base.html.twig
-   Pour le form theme de la page d'inscription, il faut rajouter 'form_themes: ['bootstrap_5_layout.html.twig']' (doc symfony) dans le fichier config / packages / twig.yaml

`An exception occurred while executing a query: SQLSTATE[23000]: Integrity constraint violation: 1048 Column 'created_at' cannot be null`

-   Pour rectifier, il faut rajouter dans User.php dans la methode construct le setCreatedAt() (Voir commentaire)

-   Test de connexion avec un nouvel utilisateur

## CRUD POUR COMPTE ADMINISTRATEUR

-   Créer un compte Admin
-   Avec le nouveau compte Admin créé, il faut aller sur phpmyadmin et mettre le role ["ROLE_ADMIN"] a l'administrateur
-   Reconnexion avec le compte, et la barre de debug de twig indique bien que l'on est connecté en tant qu'administrateur

-   `symfony console make:crud`

The class name of the entity to create CRUD (e.g. BravePuppy):

> Video

Choose a name for your controller class (e.g. VideoController) [VideoController]:

>

Do you want to generate tests for the controller?. [Experimental] (yes/no) [no]:

>

created: src/Controller/VideoController.php
created: src/Form/VideoType.php
created: templates/video/\_delete_form.html.twig
created: templates/video/\_form.html.twig
created: templates/video/edit.html.twig
created: templates/video/index.html.twig
created: templates/video/new.html.twig
created: templates/video/show.html.twig

Success!

Next: Check your new CRUD by going to /video/

---

-   De la, faire un dossier includes pour les dissocier des vues de bases
-   Dans VideoController.php, on enlevera la partie edit, dont la vue twig a étée supprimée
-   On ajoutera #[isGranted('ROLE_ADMIN')] sur chaque methode (pas sur l'ensemble car il faut garder le 'app_video_show' aux utilisateurs) en pensant a instancier le use
-   Il faudra préfixer la route

## CREATION DES TAGS

-   En dur, dans la BDD, mais normalement à faire avec des fixtures

## MODIFICATIONS DIVERSES

-   VideoType.php pour adapter le formulaire
-   index.html.twig du dossier video avec Bootstrap
-   new.html.twig de video, changer le include video par video/includes car on a changer les dossiers et on récupere le template de index pour le mettre dessus
-   \_form.html.twig sera adapté aussi
-   Il faudra changer dans Video.php, Playlist.php et Tag.php, et mettre $tag et $playlist au pluriel

-   Pour avoir les vidéos dans index, il faut faire une boucle des vidéos
-   Pour que ça fonctionne, il faut envoyer la vidéo à la page home. Donc sur HomeController.php, il faudra envoyer les vidéos en findAll (voir commentaires)

-   "Si j'accède a la fiche de la vidéo, il faut que j'ai la vidéo" donc je récupère des éléments de index.html.twig pour les ajouter dans show.html.twig

-   Mettre tout un systeme d'ajout a la playlist par un bouton dans show.html.twig. On prépare la boucle puis on initialise un CRUD.

-   `symfony console make:crud Playlist`

Choose a name for your controller class (e.g. PlaylistController) [PlaylistController]:

>

Do you want to generate tests for the controller?. [Experimental] (yes/no) [no]:

>

created: src/Controller/PlaylistController.php
created: src/Form/PlaylistType.php
created: templates/playlist/\_delete_form.html.twig
created: templates/playlist/\_form.html.twig
created: templates/playlist/edit.html.twig
created: templates/playlist/index.html.twig
created: templates/playlist/new.html.twig
created: templates/playlist/show.html.twig

Success!

Next: Check your new CRUD by going to /playlist/

---

-   On indiquera dans le controller généré que n'importe qui peux faire la playlist, mais il faudra être connecté
-   On copie le index.html.twig de vidéo et on le colle en l'adaptant
-   Dans le dossier templates, on crée un nouveau dossier includes ou on mettra \_delete.form.html.twig et \_form.html.twig
-   On copie colle le new.html.twig de video qu'on mettra dedans en y faisant les modifications nécéssaires
-   Dans PlaylistController.php, on enleve le edit et le show (pareil dans les templates)
-   Modification de \_form.html.twig de playlist par le \_form.html.twig de video
-   Ajouter le createdAt dans le contructeur de Playlist.php

-   Chercher les playlists et les ajouter: Dans videoController.php, quand je suis sur une vue show, il faudra sortir les playlists du user
-   Pour associer playlist a vidéo, il faudra refaire une route dans PlaylistController.php
