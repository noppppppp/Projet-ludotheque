# Premier projet : Ludotheque 
Un projet simple pour gérer et suivre une collection de jeux vidéo avec PHP et PostgreSQL.

## Les fonctionnalités
- Affichage de la liste des jeux.
- Calcul automatique des statistiques (Total, Valeur, % de jeux complets).
- Ajout de nouveaux jeux via un formulaire.

##  Installation
1. Clonez ce dépôt.
2. Utilisez le fichier `database.sql` pour créer la base de données
3. Créez un fichier `includes/db.php` basé sur `includes/db.php.example`.

## Version
**v1.0** - Structure de base et design.

##  Évolutions prévues 

###  Navigation & Recherche
-  **Recherche dynamique** : Barre de recherche par nom de jeu en temps réel.
-  **Système de filtres** : Filtrer la collection par console (ex: afficher uniquement la PS1, N64, etc.).
-  **Tri intelligent** : Classer par prix décroissant, date d'ajout ou état de complétion.

###  Interface & Design
-  **Mode Sombre / Jour** : Pour un meilleur confort visuel.
-  **Design Responsive** : Pour gérer l'affichage sur mobile.

###  Sécurité
-  **Accès restreint** : Mise en place d'un système d'authentification pour sécuriser l'ajout et la suppression de jeux.

###  Fonctionnalités Avancées
- **Prix en temps réel** : Récupération automatique de la valeur estimée des jeux en temps réel via API pour garder la collection à jour.
