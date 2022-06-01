import { createApp } from 'vue';
import App from './components/App.vue'
import Router from './router/index';
import Store from './store/index';


createApp(App).use(Router).use(Store).mount("#app")
