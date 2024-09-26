import { createApp } from 'vue';
import Brands from './components/Brand/Brands.vue';
import Products from './components/Product/Products.vue';
import Clients from './components/Client/Clients.vue';
import Orders from './components/Order/Orders.vue';
import Statistics from './components/shared/Statistics.vue';
import Incomes from './components/shared/Incomes.vue';
import CurrentProfit from './components/Incomes/Current_profit.vue';
import Logout from './components/shared/Logout.vue';
import './bootstrap';

const app = createApp({})

app.component('component-brands', Brands)
app.component('component-products', Products)
app.component('component-clients', Clients)
app.component('component-orders', Orders)
app.component('component-statistics', Statistics)
app.component('component-incomes', Incomes)
app.component('component-incomes-current-profit', CurrentProfit)
app.component('component-logout', Logout)
app.mount('#app')
