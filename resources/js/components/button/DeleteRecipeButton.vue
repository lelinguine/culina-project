<template>
    <AlertDialog>
        <AlertDialogTrigger as-child>
            <Button variant="destructive" @click="disableButton">
                <component :is="Trash" /> Supprimer
            </Button>
        </AlertDialogTrigger>
        <AlertDialogContent>
            <AlertDialogHeader>
                <AlertDialogTitle>Êtes-vous absolument sûr ?</AlertDialogTitle>
                <AlertDialogDescription>
                Cette action est irréversible. Cela supprimera définitivement votre recette et effacera les données de nos serveurs.
                </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
                <Button :disabled="isButtonDisabled" variant="destructive" @click="deleteRecipe">
                    <component :is="Trash" /> Supprimer
                </Button>
                <AlertDialogCancel @click="resetButton">Annuler</AlertDialogCancel>
            </AlertDialogFooter>
        </AlertDialogContent>
    </AlertDialog>

</template>

<script setup lang="ts">
    import { ref } from 'vue';
    import { Trash } from "lucide-vue-next";
    import Button from '@/components/ui/button/Button.vue';

    import {
        AlertDialog,
        AlertDialogCancel,
        AlertDialogContent,
        AlertDialogDescription,
        AlertDialogFooter,
        AlertDialogHeader,
        AlertDialogTitle,
        AlertDialogTrigger,
    } from '@/components/ui/alert-dialog';

    const isButtonDisabled = ref(true);

    const disableButton = () => {
        isButtonDisabled.value = true;
        setTimeout(() => {
            isButtonDisabled.value = false;
        }, 2000);
    };

    const resetButton = () => {
        isButtonDisabled.value = true;
    };

    // -------------------------------- Fetch recipe --------------------------------
    import useRecipeController from '@/controllers/RecipeController';
    const { deleteRecipe } = useRecipeController();

</script>