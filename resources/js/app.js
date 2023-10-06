import { createApp } from 'vue';
import Brands from './components/Brands.vue';
import './bootstrap';

const app = createApp({})

app.component('component-brands', Brands)
app.mount('#app')
