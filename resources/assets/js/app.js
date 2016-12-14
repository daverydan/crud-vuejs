window.Vue = require('vue')
require('vue-resource')

var token = document.querySelector('meta[name=csrf-token]')

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', token.content);
    next();
})

Vue.component('fetch-users', require('./components/fetchUser.vue'))

const app = new Vue({
    el: '#app'
});
