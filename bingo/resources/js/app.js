require('./bootstrap');

import { createApp } from 'vue';
import router from './router';
import mitt from 'mitt';


const emitter = mitt();

// initialise app
const app = createApp({
    data(){
        return {
            path : {
                serveur : "",
                user : ""
            },
        }
    },
    router
})




/* 
|------------------------------------------|
|                   compenent              |
|------------------------------------------|
*/
app.component('slider', require('./components/layouts/admin/slider.vue').default);
app.component('image-uploader', require('./components/layouts/input/imageUploader.vue').default);
app.component('file-uploader', require('./components/layouts/input/fileUploader.vue').default);



app.use(router);
app.config.globalProperties.emitter = emitter;

app.mount("#contente-element");

