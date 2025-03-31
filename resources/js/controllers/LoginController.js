import axios from 'axios';
import { useStateStore } from '@/stores/stateStore';
import { useRouter } from 'vue-router';

export default function useLoginController() {
    const stateStore = useStateStore();
    const router = useRouter();

    const url = stateStore.url;

    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.withCredentials = true;

    const login = async (email, password, errorMessage) => {
        try {
            const response = await axios.post(url + '/login', { email, password });
            stateStore.setUser(response.data.user);
            stateStore.setToken(response.data.token);
            stateStore.setNotification("login");
            router.push('/');
        } catch (error) {
            errorMessage.value = "Email ou mot de passe incorrect.";
        }
    };

    const loginWithGoogle = async (credential) => {
        try {
            const data = await axios.post(url + "/auth/google/callback", {
                credential: credential,
            });
            stateStore.setUser(data.data.user);
            stateStore.setToken(data.data.token);
            stateStore.setNotification("login");
            router.push('/');
        } catch (error) {
            console.error("Erreur d'authentification", error);
        }
    };

    const logout = async () => {
        try {
            await axios.post(url + "/logout", {}, {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                }
            });
            stateStore.setUser(null);
            stateStore.setToken(null);
            stateStore.setNotification("logout");
            router.push('/login');
        } catch (error) {
            console.error("Logout error:", error.response ? error.response.data : error);
        }
    };

    const session = async () => {
        try {
            const response = await axios.get(url + "/check-auth", {
                headers: {
                    Authorization: `Bearer ${stateStore.token}`
                }
            });
            stateStore.setUser(response.data.user);
        } catch (error) {
            console.error("Auth check error:", error.response ? error.response.data : error);
            router.push('/login');
        }
    };

    return { login, loginWithGoogle, logout, session };
}