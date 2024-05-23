import {createBootstrap} from 'bootstrap-vue-next';

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-icons/font/bootstrap-icons.min.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'

import {createApp} from 'vue';
import App from './app.vue';
import {Utility} from "./utility";

createApp(App).provide('Utility', new Utility()).use(createBootstrap).mount('#app');
