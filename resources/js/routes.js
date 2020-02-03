import VueRouter from "vue-router"

let routes = [
    {
        path: '/',
        components: require('./components/Home')
    },
    {
        path: '/about',
        components: require('./components/About')
    }
]

export default new VueRouter({
    mode: 'history',
    routes
})
