import axios from 'axios';
import { useStateStore } from '@/stores/stateStore';
import { useRouter } from 'vue-router';

export default function useUserController() {
    const stateStore = useStateStore();
    const router = useRouter();

    const url = stateStore.url;

    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.withCredentials = true;

    const register = async (name, email, password, errorMessage) => {
        try {
            const response = await axios.post(url + "/register", {
              name: name,
              email: email,
              password: password,
              password_confirmation: password,
            });
            stateStore.setNotification("register");
            router.push('/login');
          } catch (error) {
            errorMessage.value = "Erreur d'inscription, veuillez réessayer";
          }
    }

    const editProfile = async (name) => {
      try {
        const response = await axios.patch(url + "/users/" + stateStore.user.id, {
          name: name,
        }, {
          headers: {
            Authorization: `Bearer ${stateStore.token}`
          },
        });
        stateStore.setUser(response.data);
      } catch (error) {
        console.error("Erreur lors de la mise à jour du profil :", error);
      }
    }

    return { register, editProfile };
}