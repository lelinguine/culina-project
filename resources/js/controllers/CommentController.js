import axios from 'axios';
import { useStateStore } from '@/stores/stateStore';
import { useRouter, useRoute } from 'vue-router';

export default function useCommentController() {
    const stateStore = useStateStore();
    const router = useRouter();
    const route = useRoute();

    const url = stateStore.url;

    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.withCredentials = true;

    const seePendingComments = async () => {
        try {
            const response = await axios.get(url + "/comments/pending", {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                },
            });
            return response.data;
        } catch (error) {
            console.error("Erreur lors de la récupération des commentaires:", error);
        }
    }

    const addComment = async (recipe_id, comment) => {
        try {
            const response = await axios.post(url + "/comments", {
                "recipe_id": recipe_id,
                "user_id": stateStore.user.id,
                "content": comment
            }, {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                }
            });
            stateStore.setNotification('addComment');
            return response.data;
        } catch (error) {
            console.error("Erreur lors de l'ajout du commentaire:", error);
        }
    }

    const approveComment = async (comment_id) => {
        try {
            const response = await axios.patch(url + "/comments/" + comment_id, {
                "status": "published"
            }, {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                }
            });
            stateStore.setNotification('publishedComment');
            return response.data;
        } catch (error) {
            console.error("Erreur lors de l'ajout du commentaire:", error);
        }
    }

    return {
        addComment,
        approveComment,
        seePendingComments,
    };
}