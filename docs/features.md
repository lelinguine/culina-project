[Retour](../readme.md)
# projet-valentin-kadir/Culina/Features

Dans le cadre du cours programmation web serveur, nous avons conçu un site internet nommé Culina, une plateforme dédiée au partage et à la découverte de recettes de cuisine. Ce site offre une expérience permettant à chacun de consulter, publier et interagir autour de recettes variées.

## Utilisateur
### Google
- Un utilisateur est créé lors de votre connexion avec Google en récupérant les informations de ce dernier. Par défaut il est simple "User".

### User
- Adresse mail : jane@example.com
- Mot de passe : password123

### Admin
- Adresse mail : admin@example.com
- Mot de passe : password123

## Fonctionnalités
### /Connexion
- Il est possible de créer un compte personnel ou de se connecter si l’on possède déjà un compte.
- Une connexion via un compte Google est également proposée pour plus de simplicité.

### /Explorer
- Depuis la page d’accueil, les utilisateurs peuvent visualiser les recettes disponibles.
- Un moteur de recherche permet de retrouver des recettes en saisissant leur nom.
- Il est également possible de filtrer les recettes en cliquant sur les filtres proposés.

### /Commentaires
- Seul un utilisateur "admin" peut la voir et y accèder.
- L'utilisateur peut approuver des commentaires.

### /Recette
- En cliquant sur une recette, l’utilisateur est redirigé vers une page dédiée où il peut consulter l’ensemble des informations.
- Il est possible d’ajouter un commentaire (en attente d'approbation), d’enregistrer la recette en favoris, ou de revenir à la page précédente grâce à un bouton de retour.
- Les commentaires approuvés associés à chaque recette est visible.

### /Informations
- Une page permet à l’utilisateur de consulter son nom d’utilisateur et son adresse mail.
- Il est possible de modifier son nom d’utilisateur via le bouton "Modifier".

### /Patagés
- Regroupe toutes les recettes publiées par l’utilisateur.
- Depuis cette page, il est possible de créer une nouvelle recette en cliquant sur le bouton "Créer".
- Chaque recette peut être enrichie avec un media.

### /Favoris
- Permet à l’utilisateur de retrouver toutes les recettes qu’il a enregistrées.

### /Déconnexion
- Une fonctionnalité permet de se déconnecter à tout moment pour sécuriser son compte.

## Autres
### Personnalisation de l’interface
- Les utilisateurs ont la possibilité de changer le mode d’affichage du site (mode clair/sombre/automatique).

### Notifications
- Les utilisateurs reçoivent des notifications en cas d’erreurs ou de succès (Connexion/Déconnexion/Création de recette... etc).

### Sécurité
- Les actions sensibles, tel que la suppression de recette, sont protégées par des confirmations pour éviter les erreurs.
- Un jeton d'authentification est créé lors de la connexion, il sert à toutes les requêtes, si le jeton est invalide l'utilisateur est déconnecter.