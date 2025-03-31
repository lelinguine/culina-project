import { defineStore } from 'pinia';
import { ref } from 'vue';

import axios from 'axios';

export const useStateStore = defineStore('data', () => {
    const user = ref(null);
    const token = ref(null);

    const notification = ref(null);

    const url = 'http://localhost:8000/api';

    const initializeStore = () => {
        user.value = JSON.parse(localStorage.getItem('user'));
        token.value = localStorage.getItem('token');
    };

    initializeStore();

    const setUser = (userData) => {
        user.value = userData;
        localStorage.setItem('user', JSON.stringify(userData));
    };

    const setToken = (tokenData) => {
        token.value = tokenData;
        localStorage.setItem('token', tokenData);
    };

    const setNotification = (notificationData) => {
        notification.value = notificationData;
    }

    return { 
        user,
        token,
        notification,
        url,
        setUser,
        setToken,
        setNotification
    };
});
