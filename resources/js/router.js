import { createRouter, createWebHistory } from 'vue-router';

import Progress from '@views/Progress.vue';

import Login from '@views/Users/Login.vue';
import Register from '@views/Users/Register.vue';

import Profile from '@views/Users/Profile.vue';
import Shared from '@views/Users/Shared.vue';
import Liked from '@views/Users/Liked.vue';

import Comments from '@views/Admin/Comments.vue';

import Main from '@views/Main.vue';
import Test from '@views/Test.vue';

import Explore from '@views/Explore.vue';
import Recipe from '@views/Recipe.vue';

const routes = [
    { path: '/', component: Progress },

    {
      path: '/app',
      component: Main,
      children: [
        {path: '/app/explore', component: Explore},
        {path: '/app/explore/:recipe_id', component: Recipe},

        {path: '/app/test', component: Test},

        {path: '/app/profile', component: Profile},
        {path: '/app/shared', component: Shared},
        {path: '/app/liked', component: Liked},

        {path: '/app/comments', component: Comments},
      ],
    },

    { path: '/login', component: Login },
    { path: '/register', component: Register },
  ];

export default createRouter({
    history: createWebHistory(),
    routes,
});