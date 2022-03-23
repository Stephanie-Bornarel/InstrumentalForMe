# Carnet de bord

## Sprint 0

### Vendredi 26/11/21

- Début d'élaboration du cahier des charges
- Début du MCD
  
### Lundi 29/11/21

- Fin de rédaction du cahier des charges
- MCD réaliser avec Draw.io :https://marketplace.visualstudio.com/items?itemName=hediet.vscode-drawio
- Wireframe mobile et desktop 
 - Nous avons créer nos wireframe avec: https://whimsical.com/
- Dictionnaire de données
  
### Mardi 30/11/21

- A faire:

 - Définition du thème bootsrap:
   - Nous avons trouvé ce thème qui correspond tout à fait à ce que nous voulions :
    https://startbootstrap.com/previews/one-page-wonder
 - Trello
   - https://trello.com/b/kSZ3MaMF/instrumental4me
 - MLD et MPD
 - Logo du site 
   - Créer sur le site : https://fr.freelogodesign.org/
  
### Mercredi 01/12/21

- Réunion avec nos helper Damien et Guillaume concernant notre démarrage du projet.
  - Correction des points :
    - MCD : table like
    - User storie : ajout de "pouvoir supprimer mon compte" et "liker un prof"
    - wireframe: 
      - ajout d'un lien supprimer mon compte 
      - d'un lien email élève sur la liste des élèves (dans page prof)
      - d'une page "modifier votre profil"
    - CDC : 
      - Modification de l'arborescence 
      - modif des routes dans le CDC
- On à fait une liste des instruments que nous allions présenter en premier sur le sîte.
 
### Jeudi 02/12/21

- Modifications:
  - Wireframes
  - MCD
  - MLD
  - Dico des données :http://mocodo.wingi.net/
- Recherches des images dont nous auront besoins :
    - https://www.pexels.com/fr-fr/
    - https://pixabay.com/fr/
- MIse à jour des fonctionnalitées :
    - les likes ,le calendrier et l'upload certificate ont étaient basculés en V4
    - Ajout des taxonomies en sprint 1
- Installation de Wordpress et dépendances.
 
### Vendredi 03/12/21

- Première rétrospective : Stefan fera la 1ere présentation (du sprint 0)
- Attente de validation de notre doc pour la suite
- Commencer:
  - intégration du théme bootsrap par Stefan
  - début le plugin par Steph.M et Steph.B 

#### Résumé de la semaine

Nous avons eu quelques difficultées avec le MCD et la mise en place des routes

## Sprint 1

### Lundi 06/12/21

- Stefan se charge de la partie front
    -  (création de nos différente page ),
    -  ajout des link réseaux sociaux dans le footer,
    -  profilTeacher
 
- Steph.M continue  la partie CPT et Taxonomy du plugin 
  -  la début de la Homepage
 
- Steph.B me charge de la partie formulaire d'inscription 
  
### Mardi 07/12/21

- Prévu pour aujourd'hui:

  - Finir dynamisation de la homepage
  - Finir d'afficher les diplômes si teacher selectionner dans le formulaire d'inscription
  - Finir profil teacher et start profil student

- Ce que l'on à fait:

  - La dynamisation de la page est casiment finit :reste le lien connexion/inscription
  - Page instrument faite
  - page profil student et teacher à finir


### Mercredi 08/12/21

   - Terminer les pages profil  teacher et student 
   - Home link vers inscription/connexion et inversement une fois connecter
   - MVC Plugin
   - CSS Form inscription/connexion
     
   - Determiner les droits des users,mis en page des pages profils,mis en page des onglets, debug affichage de la page teacher view avec Stef.M et  de   user registration avec Stef.B.
   - Steph.M  finit la dynamisation la home pagedynamisation entre la home-> profils teacher
   - Steph.B finit le formulaire d'inscription ainsi que le css
 
### Jeudi 09/12/21
 
   - function et page update pour Stefan 
   - page profil student
   - afficher la liste des profs sur la page instrument et commencer la page appointment




### Vendredi 10/12/21

   - Afficher la liste des profs qui enseignent l'instrument afficher dans la page 'instrument'
   - travail sur le lien Debug enseignant vers instrument : échec
   - travail sur Debug user-home.view avec get_teh_permalink : échec
   - travail sur la mise à jour du profil, aidé par Julien pour finir la page
   - Mettre à jour la barre de navigation pour obtenir la page d'accueil
   - Mise en page de certains fichiers
   - Travaillez sur le débogage de la page du registre des nouveaux utilisateurs, obtenez à l'intérieur de la publication au lieu de l'intérieur du    plugin ... 
   - Page userHomeViews

## Sprint 2

### Lundi 13/12/21

 - Il nous reste à faire :

   - linker page update avec page profile
   - debug description profil en update ( pour le moment le 'content()' n'affiche pas le descriptif du prof)
   - page rdv + link
   - Ajout de taxo ds update profile
   - Afficher les taxo instruments dans les profils des profs sur la page instrument
   - rendre le lien 'prise de rendez-vous' clickable si connecter en tant que student
   - CustomTable Lesson!!
   - suppression de compte

- Fait:
  
   - LInker page update avec page profile
   - page rdv (a termeiner)+ link `Prendre rendez-vous`
   - ajout des taxo dans update profil+lien dans page de modif
   - Afficher les taxo instruments dans les profils des profs sur la page instrument
   - CustomTable Lesson


### Mardi 14/12/21

 - A faire:
  
   - récuperer les infos prof quand on est sur la  page appointment en cours mais difficile de recup les infos
   - model student a faire
   - route pour supp de compte
   - bouton update dans modif profil
   - dynamiser les rdv + liste cours + liste eleves/profs
   - Chager les certificats a partir du formulaire (pour le moment ne fonctionne pas)

- Fait:
 
  - Model Student 
  - abandon de la page appointment, la prise de rdv se fera sur la page teacher-profile
  - affichage des instrument et musicStyle sur la page update
  - layout teacher profile avec prise de rendez vous, layout student-profile
  - Amelioration du style pour le formulaire d'enregistrement et connexion
  - stuck a lot !!!
  - coincé sur l'enregistrement des certificats au moment de l'inscription
  - coincé sur link appointment page au teacher concerné
  - Page suppression de compte en cours

### Mercredi 15/12/21

- A faire:

  - enregistrement des certificats par le formulaire d'inscription(debug =>ne s'enregistre pas en BD)
  - creation d'une lecon au moment de la prise de rendez vous.
  - terminer la function suppression de compte
  
- Fait:

  - les certificats s'enregistrent bien par le biais du formulaire d'inscription,reste à debuger le soucis dans le formulaire update profile
  - function suppression de compte terminer
  - installation d'un calendrier en vue.js (avec l'aide de Julien) qui se retrouve sur les pages de profils personnels des users reprenant les rendez vous: reste à placer au bon endroit dans la page et gérer le css.
  - prise de rendez-vous mis en place (lesson)

### Jeudi 16/12/21

- A faire:

  - Debug du formulaire update concernant les maj des taxonomies
  - Afficher la liste des profs dans la page archive (affiche pour le moment profs et élèves)
  - layout calendar 
  - page de confirmation pour les rendez-vous
  - Validation des nouvelles demande de rendez-vous 
  - Dynamisation de la liste des cours , des élèves ou profs suivant le profil
  - page 404
    

- Fait:

  - page de confirmation pour les rendez-vous
  - Debug du formulaire update concernant les maj des taxonomies
  - Validation des nouvelles demande de rendez-vous:EN COURS


### Vendredi 17/12/21

- A faire:

  - regler l'affichage des icone de réseaux sociaux 
  - récuperer le contenu des profs et élèves dans les pages de  profils
  - Dynamisation de la liste des cours , des élèves ou profs suivant le profil
  - page 404 :en cours
  - Afficher la liste des profs dans la page archive (affiche pour le moment profs et élèves) ok
  - CSS :
        - regler taille icones des avatars 
        - affichage du logo du site (header )
        - refaire un tour sur toutes les pages pour vérifier

- Fait:

  - regler l'affichage des icone de réseaux sociaux 
  - récuperer le contenu des profs et élèves dans les pages de  profils => Annuler car l'affichage de descrpitif inutil à cette endroit
  - suppresion pour le moment de la taxo instrument pour les élèves 
  - regler taille icones des avatars

#### Lundi 20/12/21

- A faire:
 
  - page 404
  - Checkbox qui ne garde pas en mémoire la selection dans la mis a jour du profil
  
- Fait:

  - 404
  - 
