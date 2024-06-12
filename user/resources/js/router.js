import { createRouter, createWebHashHistory } from "vue-router";

import dashboard_index from "./components/page/dashboard/index.vue";

import maison_index from "./components/page/maison/index.vue";
import maison_configuration from "./components/page/maison/configuration.vue";

import message_index from "./components/page/message/index.vue";
import message_view from "./components/page/message/view.vue";

const routes = [

    { path: '/', component: dashboard_index },
    { path: '/house', component: maison_index },
    { path: '/house/configuration/:id', component: maison_configuration },

    { path: '/message', component: message_index },
    { path: '/message/view/:id', component: message_view },
];


const router = createRouter({
    history: createWebHashHistory(),
    routes
})

export default router;