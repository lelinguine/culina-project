<script setup lang="ts">
    import Toaster from '@/components/ui/toast/Toaster.vue'
    import { useToast } from '@/components/ui/toast/use-toast'

    const { toast } = useToast();
    
    const showToast = (type: string) => {

        const message = {
            title: '',
            description: ''
        };
        switch (type) {
            case "error":
                message.title = 'Erreur';
                message.description = 'Une erreur est survenue. Veuillez réessayer.';
                break;
            case "addFavorite":
                message.title = 'Recette ajoutée aux favoris';
                message.description = 'Cette recette a été ajoutée à vos favoris.';
                break;
            case "removeFavorite":
                message.title = 'Recette retirée des favoris';
                message.description = 'Cette recette a été retirée de vos favoris.';
                break;
            case "login":
                message.title = 'Connexion réussie';
                message.description = 'Vous êtes maintenant connecté.';
                break;
            case "register":
                message.title = 'Inscription réussie';
                message.description = 'Bienvenue dans la communauté Culina !';
                break;
            case "logout":
                message.title = 'Déconnexion réussie';
                message.description = 'Vous êtes maintenant déconnecté.';
                break;
            case "editProfile":
                message.title = 'Profil modifié';
                message.description = 'Votre profil a été mis à jour avec succès.';
                break;
            case "deleteRecipe":
                message.title = 'Recette supprimée';
                message.description = 'Cette recette a été supprimée de votre compte.';
                break;
            case "editRecipe":
                message.title = 'Recette modifiée';
                message.description = 'Cette recette a été mise à jour avec succès.';
                break;
            case "createRecipe":
                message.title = 'Recette ajoutée';
                message.description = 'Cette recette a été ajoutée à votre compte.';
                break;
            case "addComment":
                message.title = 'Commentaire ajouté';
                message.description = 'Votre commentaire a été ajouté avec succès. Il doit maintenant être approuvé par un modérateur.';
                break;
            case "publishedComment":
                message.title = 'Commentaire publié';
                message.description = 'Le commentaire a été publié avec succès.';
                break;
            case "uploadMedia":
                message.title = 'Média ajouté';
                message.description = 'Votre média a été ajouté avec succès.';
                break;
        }

        if(message.title && message.description) {
            toast({
                title: message.title,
                description: message.description,
                status: 'success',
                duration: 5000,
                isClosable: true,
            });
        }
    };

    defineExpose({
        showToast
    });
</script>

<template>
    <Toaster />
</template>