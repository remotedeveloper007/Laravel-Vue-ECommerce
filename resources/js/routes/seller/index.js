import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import SellerHome from '../../components/seller/SellerHome.vue'
import SellerLogin from '../../components/seller/Auth/SellerLogin.vue'
import SellerRegister from '../../components/seller/Auth/SellerRegister.vue'

let router = new VueRouter ({
    mode: 'history',

    routes: [
       { path: '/seller', name: 'Seller Dashboard', component: SellerHome, meta: { requiresAuth: true }, },
       { path: '/seller/login', name: 'Seller Login', component: SellerLogin, meta: { guest: true }, },
       { path: '/seller/register', name: 'Seller Register', component: SellerRegister, meta: { guest: true }, },
    ]
})

router.beforeEach((to, from, next) => {
    const sellerLoggedIn = localStorage.getItem('seller')

    if (to.matched.some(record => record.meta.requiresAuth) && !sellerLoggedIn)
        next({
            name: 'Seller Login',
            params: {
                nextUrl: to.fullPath
            }
        })
    else if (to.matched.some(record => record.meta.guest) && sellerLoggedIn) {
        next({
            name: 'Seller Dashboard'
        })

    } else

        next()
})

export default router