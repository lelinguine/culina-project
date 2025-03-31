<template>
    <div v-if="filteredRecipes.length" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
        <Card v-for="recipe in filteredRecipes" :key="recipe.id" class="card shadow-lg relative flex flex-col h-full cursor-pointer" @click="selectRecipe(recipe)">
            
            <img :src="recipe.media" class="rounded-t-md object-cover w-full h-48" />
            
            <CardHeader class="flex-grow">
                <CardTitle class="title">{{ recipe.title }}</CardTitle>
                <CardDescription class="text-gray-500 text-xs">{{ recipe.content }}</CardDescription>
            </CardHeader>
            <CardContent>
                <TagsList v-if="recipe" :tags="recipe.tags" />
                
            </CardContent>
            <CardFooter>
                <div class="flex flex-row items-center gap-2">
                    <component :is="MessageCircle" />
                    <span class="text-xs">{{ recipe.comments.length }} commentaires</span>
                </div>
            </CardFooter>
        </Card>
    </div>
    <p v-else class="text-gray-500 text-xs">Aucune recette ne correspond.</p>
</template>

<style scoped>
 .card:hover .title {
    text-decoration: underline;
 }
</style>

<script setup lang="ts">
    import { ref, computed, defineProps } from 'vue';

    const props = defineProps({
        filteredRecipes: {
            type: Array,
            required: true
        }
    });

    import { MessageCircle } from "lucide-vue-next"

    import {
        Card,
        CardContent,
        CardDescription,
        CardHeader,
        CardTitle,
        CardFooter
    } from '@/components/ui/card'
    import { Badge } from '@/components/ui/badge'
    import TagsList from '@/components/list/TagsList.vue';

    import { useRouter } from 'vue-router';
    const router = useRouter();

    const selectRecipe = (recipe: any) => {
        router.push(`/app/explore/${recipe.id}`);
    }
</script>