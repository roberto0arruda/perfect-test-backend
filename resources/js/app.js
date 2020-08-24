require('./bootstrap');

window.Vue = require('vue');

Vue.component('products-list', require('./components/ProductsList.vue').default);
Vue.component('product', require('./components/Product.vue').default);
Vue.component('sales-list', require('./components/SalesList.vue').default);
Vue.component('sales', require('./components/Sales.vue').default);
Vue.component('result-sales', require('./components/ResultSales.vue').default);

const app = new Vue({
    el: '#main'
})
