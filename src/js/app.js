import {createBootstrap} from 'bootstrap-vue-next';
import UIkit from 'uikit/dist/js/uikit.min.js';
import Icons from 'uikit/dist/js/uikit-icons'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-icons/font/bootstrap-icons.min.css'
import 'bootstrap-vue-next/dist/bootstrap-vue-next.css'
import "uikit/dist/css/uikit.css";
UIkit.use(Icons)

import {createApp} from 'vue';
import App from './app.vue';
import {Utility} from "./utility";

createApp(App).provide('Utility', new Utility()).use(createBootstrap).mount('#app');
