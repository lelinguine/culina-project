[Retour](../readme.md)
# projet-valentin-kadir/Culina/Endpoints

## Authentification
- **POST** `/register` : Inscription d'un utilisateur.
  - **Entrées** : 
    - `name` (string, requis) : Nom de l'utilisateur.
    - `email` (string, requis) : Email unique.
    - `password` (string, requis) : Mot de passe.
    - `password_confirmation` (string, requis) : Confirmation du mot de passe.
  - **Sorties** : 
    - `message` : Confirmation de la création.
    - `user` : Détails de l'utilisateur créé.

- **POST** `/login` : Connexion d'un utilisateur.
  - **Entrées** : 
    - `email` (string, requis) : Email de l'utilisateur.
    - `password` (string, requis) : Mot de passe.
  - **Sorties** : 
    - `message` : Confirmation de la connexion.
    - `token` : Jeton d'authentification.
    - `user` : Détails de l'utilisateur connecté.

- **POST** `/logout` : Déconnexion d'un utilisateur (nécessite un jeton d'authentification).
  - **Entrées** : Aucune.
  - **Sorties** : 
    - `message` : Confirmation de la déconnexion.

- **GET** `/check-auth` : Vérifie l'authentification de l'utilisateur (nécessite un jeton d'authentification).
  - **Entrées** : Aucune.
  - **Sorties** : 
    - `authenticated` (bool) : Statut d'authentification.
    - `user` : Détails de l'utilisateur (si authentifié).

## Google Auth
- **POST** `/auth/google/callback` : Connexion via Google.
  - **Entrées** : 
    - `credential` (string, requis) : Jeton JWT de Google.
  - **Sorties** : 
    - `message` : Confirmation de la connexion.
    - `user` : Détails de l'utilisateur.
    - `token` : Jeton d'authentification.

## Utilisateurs
- **GET** `/users/all` : Liste de tous les utilisateurs (nécessite un jeton d'authentification).
  - **Entrées** : Aucune.
  - **Sorties** : Liste des utilisateurs.

- **GET** `/users/{user_id}` : Détails d'un utilisateur spécifique (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `user_id` (int, requis) : ID de l'utilisateur.
  - **Sorties** : Détails de l'utilisateur.

- **DELETE** `/users/{user_id}` : Suppression d'un utilisateur (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `user_id` (int, requis) : ID de l'utilisateur.
  - **Sorties** : 
    - `message` : Confirmation de la suppression.

- **PATCH** `/users/{user_id}` : Mise à jour des informations d'un utilisateur (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `user_id` (int, requis) : ID de l'utilisateur.
    - Données à mettre à jour (ex. `name`, `email`).
  - **Sorties** : Détails de l'utilisateur mis à jour.

- **GET** `/users/{user_id}/comments` : Liste des commentaires d'un utilisateur (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `user_id` (int, requis) : ID de l'utilisateur.
  - **Sorties** : Liste des commentaires.

- **GET** `/users/{user_id}/recipes` : Liste des recettes d'un utilisateur (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `user_id` (int, requis) : ID de l'utilisateur.
  - **Sorties** : Liste des recettes (avec uniquement les commentaires publiés).

- **GET** `/users/{user_id}/favoris` : Liste des favoris d'un utilisateur (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `user_id` (int, requis) : ID de l'utilisateur.
  - **Sorties** : Liste des favoris (avec uniquement les commentaires publiés).

## Recettes
- **GET** `/recipes/all` : Liste de toutes les recettes (nécessite un jeton d'authentification).
  - **Entrées** : Aucune.
  - **Sorties** : Liste des recettes (avec uniquement les commentaires publiés).

- **GET** `/recipes/{recipe_id}` : Détails d'une recette spécifique (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `recipe_id` (int, requis) : ID de la recette.
  - **Sorties** : Détails de la recette (avec uniquement les commentaires publiés).

- **POST** `/recipes` : Création d'une recette (nécessite un jeton d'authentification).
  - **Entrées** : Données de la recette (ex. `title`, `description`, `ingredients`).
  - **Sorties** : Détails de la recette créée.

- **DELETE** `/recipes/{recipe_id}` : Suppression d'une recette (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `recipe_id` (int, requis) : ID de la recette.
  - **Sorties** : 
    - `message` : Confirmation de la suppression.

- **PATCH** `/recipes/{recipe_id}` : Mise à jour d'une recette (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `recipe_id` (int, requis) : ID de la recette.
    - Données à mettre à jour (ex. `title`, `description`).
  - **Sorties** : Détails de la recette mise à jour.

## Commentaires
- **GET** `/comments/all` : Liste de tous les commentaires (nécessite un jeton d'authentification).
  - **Entrées** : Aucune.
  - **Sorties** : Liste des commentaires.

- **GET** `/comments/pending` : Liste des commentaires en attente d'approbation (nécessite un jeton d'authentification).
  - **Entrées** : Aucune.
  - **Sorties** : Liste des commentaires en attente.

- **POST** `/comments` : Création d'un commentaire (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `recipe_id` (int, requis) : ID de la recette.
    - `user_id` (int, requis) : ID de l'utilisateur.
    - `content` (string, requis) : Contenu du commentaire.
  - **Sorties** : Détails du commentaire créé.

- **PATCH** `/comments/{comment_id}` : Mise à jour du statut d'un commentaire (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `comment_id` (int, requis) : ID du commentaire.
    - `status` (string, requis) : Statut du commentaire (`pending` ou `published`).
  - **Sorties** : Détails du commentaire mis à jour.

## Favoris
- **POST** `/favoris` : Affiche les favoris d'un utilisateur (nécessite un jeton d'authentification).
  - **Entrées** : Aucune.
  - **Sorties** : Liste des favoris.

- **PUT** `/favoris` : Ajout d'une recette aux favoris (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `recipe_id` (int, requis) : ID de la recette.
  - **Sorties** : 
    - `message` : Confirmation de l'ajout.

- **DELETE** `/favoris/{recipe_id}` : Suppression d'une recette des favoris (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `recipe_id` (int, requis) : ID de la recette.
  - **Sorties** : 
    - `message` : Confirmation de la suppression.

## Upload
- **POST** `/upload` : Upload d'une image (nécessite un jeton d'authentification).
  - **Entrées** : 
    - `image` (fichier, requis) : Image à uploader (max 5 Mo).
  - **Sorties** : 
    - `url` : URL de l'image uploadée.