import axios from 'axios';
import { useStateStore } from '@/stores/stateStore';
import { useRouter, useRoute } from 'vue-router';

export default function useRecipeController() {
    const stateStore = useStateStore();
    const router = useRouter();
    const route = useRoute();

    const url = stateStore.url;

    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.withCredentials = true;

    const fetchRecipes = async () => {
        try {
            const response = await axios.get(url + "/recipes/all", {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                },
            });
            
            return response.data;
        } catch (error) {
            console.error("Erreur lors du chargement des recettes:", error)
        }
        return response.data;
    }   

    const fecthRecipe = async () => {
        try {
            const recipe_id = route.params.recipe_id;
        
            const response = await axios.get(url + "/recipes/" + recipe_id, {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                },
            });
        
            return response.data;
        } catch (error) {
            console.error("Erreur lors de la récupération de la recette:", error);
        }
    }

    const createRecipe = async (recipe) => {
        try {
            const response = await axios.post(url + "/recipes", {
                "title": recipe.title,
                "tags": recipe.tags,
                "content": recipe.content,
                "media": recipe.media,
                "ingredients": "empty",
                "status": "published",
                "user_id": stateStore.user.id,
              }, {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                },
            });
            stateStore.setNotification("createRecipe");
            router.push("/app/explore/" + response.data.id);
        } catch (error) {
            console.error("Erreur lors de la création de la recette:", error);
        }
    }

    const editRecipe = async (recipe) => {
        try {

            const response = await axios.patch(url + "/recipes/" + recipe.id, {
                "title": recipe.title,
                "tags": recipe.tags,
                "content": recipe.content,
                "media": recipe.media,
                "ingredients": recipe.ingredients,
                "status": recipe.status
              }, {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                },
            });
            stateStore.setNotification("editRecipe");
            return response.data;
        } catch (error) {
            stateStore.setNotification("error");
            console.error("Erreur lors de la mise à jour de la recette:", error);
        }
    }

    const deleteRecipe = async () => {
        try {
            const recipe_id = route.params.recipe_id;

            await axios.delete(url + "/recipes/" + recipe_id, {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                },
            });
            stateStore.setNotification("deleteRecipe");
            router.go(-1);
        } catch (error) {
            stateStore.setNotification("error");
            console.error("Erreur lors de la suppression de la recette:", error);
        }
    };

    const fetchShared = async () => {
        try {
            const response = await axios.get(url + "/users/" + stateStore.user.id + "/recipes", {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                },
            });
            return response.data;
        } catch (error) {
            console.error("Erreur lors du chargement des recettes:", error)
        }
    }

    const fetchFavorites = async () => {
        try {
            const response = await axios.get(url + "/users/" + stateStore.user.id + "/favoris", {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                },
            });
            return response.data.map(favori => favori.recipe);
        } catch (error) {
            console.error("Erreur lors du chargement des recettes:", error)
        }
    }

    const fetchFavorite  = async (recipe_id) => {
        try {
          const response = await axios.post(url + "/favoris", {
            "recipe_id": recipe_id
          }, {
            headers: {
                Authorization: `Bearer ${stateStore.token}`
            }
          });
          return response.data[0] ? true : false;
        } catch (error) {
          console.error("Erreur lors de la récupération:", error);
        }
    };

    const addFavorite = async (recipe_id) => {
        try {
            await axios.put(url + "/favoris", {
                "recipe_id": recipe_id
            }, {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                }
            });
            stateStore.setNotification('addFavorite');
        } catch (error) {
            console.error("Erreur lors de la récupération:", error);
        }
    }

    const removeFavorite = async (recipe_id) => {
        try {
            await axios.delete(url + "/favoris/" + recipe_id, {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                }
            });
            stateStore.setNotification('removeFavorite');
        } catch (error) {
            console.error("Erreur lors de la suppression :", error);
            return false;
        }
    };

    const uploadMedia = async (formData) => {
        try {
            const response = await axios.post(url + "/upload", formData, {
              headers: {"Content-Type": "multipart/form-data",
                Authorization: `Bearer ${stateStore.token}`
              },
            });
            stateStore.setNotification("uploadMedia");
            return response.data.url;
          } catch (error) {
            console.error("Erreur lors de l'upload :", error);
          }
    }
    
    return {
        fetchRecipes,
        fecthRecipe,
        deleteRecipe,
        fetchFavorites,
        fetchFavorite,
        fetchShared,
        addFavorite,
        removeFavorite,
        createRecipe, 
        editRecipe,
        uploadMedia };
}