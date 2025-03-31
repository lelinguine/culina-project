<template>
    <div id="googleSignInBtn"></div>
</template>

<script setup>
    import { onMounted, ref} from "vue";

    // -------------------------------- Login --------------------------------
    import useLoginController from '@/controllers/LoginController';
    const { loginWithGoogle } = useLoginController();

    // -------------------------------- Google --------------------------------
    import axios from 'axios';

    const handleCredentialResponse = async (response) => {
        await loginWithGoogle(response.credential);
    };

    const clientId = "22853817032-0622fbgmh2k61hnq4gsni1vcfiivr3pu.apps.googleusercontent.com";

    const initGoogleSignIn = () => {
        if (window.google) {
            google.accounts.id.initialize({
                client_id: clientId,
                callback: handleCredentialResponse
            });
            google.accounts.id.renderButton(
                document.getElementById("googleSignInBtn"),
                { theme: "outline" }
            );
        } else {
            console.error("Le script Google Sign-In n'a pas été chargé.");
        }
    };

    onMounted(() => {
        if (!document.getElementById("google-signin-script")) {
            const script = document.createElement("script");
            script.src = "https://accounts.google.com/gsi/client";
            script.async = true;
            script.defer = true;
            script.id = "google-signin-script";
            script.onload = initGoogleSignIn;
            document.body.appendChild(script);
        } else {
            initGoogleSignIn();
        }
    });

</script>