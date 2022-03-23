# Instrumental for me!

### Présentation  
Le but du website serait de mettre en relation des gens qui souhaitent enseigner à jouer d'un instrument de musique avec des personnes qui souhaitent apprendre. Les cours se ferait en visio (google meet ou autre...).  


### Définitions des besoins et des objectifs auquels répond le projet:

- Côtés pratique pour les personnes habitants loin d'un lieu d'enseignement.
- En cas de confinement (ex:nouvelle pandémie).
- Facilité d'apprentissage pour les personnes introverties qui souhaite éviter la foule ou tout simplement les interactions sociales que l'on est obligé d'avoir quand on croise trop de monde.
- Gestion de l'emploi du temps (pas de déplacement,...). Apprendre à jouer d'un instrument en visio, cela permet de limiter les déplacements, on gagne du temps pour pouvoir faire autre chose.
- ...

### Fonctionnalitées du projet:

##### MVP

- Connexion
- Inscription
- page instruments (homepage)
- Page profil perso :
  - profs (teacher)
  - eleves (student)
- link profs/instrument
- Prise de rendez-vous (date & time picker)
- Taxonomies : instruments, certificates, music styles

#####  Planning de dévelopement

  | SPRINT 0      | SPRINT 1                        | SPRINT 2                                                                               | SPRINT 3                      |
  | ------------- | ------------------------------- | -------------------------------------------------------------------------------------- | ----------------------------- |
  | --            | Integration theme + plugin      | Taxonomies                                                                             | --                            |
  | documentation | page instrument ( presentation) | page instrument (presentation + lien vers les professeurs qui enseignent l’instrument) | test/debug                    |
  | --            | page connexion                  | page professeur (prise de RDV)                                                         | amelioration visuelle du site |
  | --            | Page inscription                | page modifier son profil                                                               | --                            |
  | --            | page profil (prof + eleve)      | Suppression de compte                                                                  | --                            |
  | --            |                                 | --                                                                                     | --                            |


  - V2:
    - gestion des paiements en ligne (woo commerce)
    - Home (affichage des profs/instrument?)
    - catégories pour les instruments
    - page eleve (depot d'avis)
    - niveau possible des cours : debutant, faux debutant, intermediaire, avancé...
    - supprimer un rendez-vous

- V3:
    - envoie auto d'un lien (pour l'élève et le prof) vers google meet aprés inscription de l'élève à son cours 
    - page d'activité (page activité regroupant des projet/propositions faits par les profs ou clients : par exemple se retrouver un jour donné sur google meet (ou autre) pour l'enregistrement d'une video youtube OU se retrouver a un endroit donné pour participer a un evenement musical et monter sur scene pour une apparition, un concert remunéré ou bénévole...)

- V4:
    - like (maybe)
    - upload certificate

### Liste des technologies

- wordpress
- php
- vue.js (calendrier)
- bootstrap


### Définition de la cible du projet

Le projet cible un public adulte et enfant souhaitant apprendre à jouer d'un instrument de musique.

### Navigateurs compatibles

Compatible :
- Chrome
- Firefox
- 
A tester :
- Edge
- Safari

### Arborescence  


<div style="background-color: #e8eef0">


  ```mermaid
  graph TD;

 404 

 Home-Instrument--->**Profil-prof**--->**Profil-élève**-->**MAJ-profile**
 Home-Instrument--->**Profil-élève**-->**Profil-prof**-->**MAJ-profile**



 Home-Instrument--->Connexion-->**Profil-élève**
 Connexion-->**Profil-prof**
 
 Home-Instrument--->Inscription-->**Profil-élève**
 Inscription-->**Profil-prof**

 Home-Instrument--->Instrument-->**Profil-prof**-->**Confirmation\prise\de\RDV

   

```

 **Les `** xxxx **` indique que l'utilisateur doit être connecté pour acceder à ces pages**
</div>

### Liste des routes

- home
- register
- login
- delete-account
- student-profile
- teacher-profile
- certificate
- music-style
- instrument
- user-home
- update-profile
- appointment
- 404
 
  ## liste des routes à créer
  
 | URL                                | HTTP Method | Controller              | Method          | Title                   | Content         | Comment |
 | ---------------------------------- | ----------- | ----------------------- | --------------- | ----------------------- | --------------- | ------- |
 | `/`                                | `GET, POST` | `---`                   | `---`           | Page d'accueil          | home page       | wp      |
 | `/wp/wp-login.php?action=register` | `POST`      | `---`                   | `---`           | page d'inscription      | register page   | wp      |
 | `/wp/wp-login.php`                 | `GET`       | `---`                   | `login`         | Connexion               | login           | -       |
 | `/user/delete-account/`            | `GET`       | `UserController`        | `deleteAccount` | page suppression compte | delete account  | -       |
 | `/user/update-profile/`            | `GET`       | `UserController`        | `updateProfile` | MAJ compte              | update account  | -       |
 | `/user/update-profile/`            | `POST`      | `UserController`        | `saveProfile`   | MAJ compte              | update account  | -       |
 | `/student/profile/`                | `GET`       | `---`                   | `---`           | profil élève            | student profile | wp      |
 | `/teacher/profile/`                | `GET`       | `---`                   | `---`           | profil prof             | teacher profile | wp      |
 | `/instrument/nameofinstrument/`    | `GET`       | `---`                   | `---`           | page instrument         | instrument      | wp      |
 | `/teacher/take-lesson`             | `POST`      | `UserController`        | `takeLesson`    | page non apparente      | ---             | -       |
 | `/teacher-appointment/`            | `GET`       | `AppointmentController` | `appointment`   | page appointment        | RDV             | -       |
 | `/certificate/`                    | `GET`       | `---`                   | `---`           | page certificat         | certificate     | wp      |
 | `/music-style/`                    | `GET`       | `---`                   | `---`           | page style musique      | music style     | wp      |
 | `/404/`                            | `GET`       | `---`                   | `---`           | page erreur             | 404             | wp      |


- V2
  - (about => contact,mentions légales)
 
 
 ### Users stories

 | En tant que | Je veux                                             | Afin de (si besoin/nécessaire)           |
 | ----------- | --------------------------------------------------- | ---------------------------------------- |
 | Visiteur    | pouvoir consulter la liste des instruments          | voir quels instruments sont enseignés    |
 | Visiteur    | pouvoir consulter la liste des professeurs          | voir les professeurs qui enseignent      |
 | Visiteur    | pouvoir m'inscrire                                  | prendre des leçons                       |
 | Elève       | pouvoir me connecter                                | vérifier mon compte, prendre des rdv     |
 | Elève       | pouvoir consulter ma page perso                     | vérifier mes informations                |
 | Elève       | pouvoir modifier ma page de profil                  | mettre mes informations à jour           |
 | Elève       | pouvoir prendre rendez-vous                         | prendre une leçon                        |
 | Elève       | pouvoir consulter la liste des instruments          | voir quels instruments sont enseignés    |
 | Elève       | pouvoir consulter la liste des professeurs          | voir les professeurs qui enseignent      |
 | Elève       | pouvoir consulter la page de profil d'un professeur | voir les disponibilités de ce professeur |
 | Elève       | pouvoir supprimer mon compte                        | pouvoir le faire si j'en ai envie        |
 | Professeur  | pouvoir me connecter                                | vérifier mon compte, prendre des rdv     |
 | Professeur  | pouvoir consulter ma page perso                     | vérifier mes informations                |
 | Professeur  | pouvoir modifier ma page de profil                  | mettre mes informations à jour           |
 | Professeur  | pouvoir confirmer un rendez-vous                    | pouvoir donner des leçons                |
 | Professeur  | pouvoir consulter mon agenda                        | vérifier mes rdv confirmés               |
 | Professeur  | pouvoir supprimer mon compte                        | pouvoir le faire si j'en ai envie        |

### La liste des rôles de chacun

- PRODUCT OWNER: Stefan
- SCRUM MASTER,: Stephanie B
- LEAD DEV: Stephanie M
- GIT MASTER: Stefan 
- REFERENT TECHNIQUE: Stephanie B


