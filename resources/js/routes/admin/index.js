import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import AdminHome from '../../components/admin/AdminHome.vue'
import AdminLogin from '../../components/admin/Auth/AdminLogin.vue'

//
import ManageCategory from "../../components/Category/ManageCategory.vue";
import ManageSubCategory from "../../components/Subcategory/ManageSubCategory.vue";
import AddProduct from "../../components/Product/AddProduct.vue";
import EditProduct from "../../components/Product/EditProduct.vue";
import ManageProduct from "../../components/Product/ManageProduct.vue";
import ProductAttributes from "../../components/Product/ProductAttributes.vue";
import AlternateImage from "../../components/Product/AlternateImage.vue";
import ManageCoupon from "../../components/Coupon/ManageCoupon.vue";
import ManageOrder from "../../components/admin/pages/ManageOrders.vue";
import OrderDetails from '../../components/admin/pages/OrderDetails.vue';

let router = new VueRouter({

    mode: 'history',
    linkExactActiveClass: "sidebar-active-class",
    routes: [
        /**
         * Backend Display for Admin Login Component
         */

        {
            path: '/admin/login',
            name: 'Admin Login',
            component: AdminLogin,
            meta: {
                guest: true
            },
        },

        /**
         * Backend Display for Admin Dashboard and a fter login components
         */
        {
            path: '/admin',
            name: 'Admin Dashboard',
            component: AdminHome,
            meta: {
                requiresAuth: true
            },
        },
        {
            path: "/admin/manage-category",
            name: "Category",
            component: ManageCategory,
            meta: {
                requiresAuth: true
            },
        },
        {
            path: "/admin/manage-subcategory",
            name: "Subcategory",
            component: ManageSubCategory,
            meta: {
                requiresAuth: true
            },
        },
        {
            path: "/admin/add-product",
            name: "AddPro",
            component: AddProduct,
            meta: {
                requiresAuth: true
            },
        },
        {
            path: "/admin/edit-product/:id",
            name: "EditPro",
            component: EditProduct,
            meta: {
                requiresAuth: true
            },
        },
        {
            path: "/admin/manage-product",
            name: "ManagePro",
            component: ManageProduct,
            meta: {
                requiresAuth: true
            },
        },
        {
            path: "/admin/manage-attributes/:pid",
            name: "Attributes",
            component: ProductAttributes,
            meta: {
                requiresAuth: true
            },
        },
        {
            path: "/admin/manage-images/:id",
            name: "Images",
            component: AlternateImage,
            meta: {
                requiresAuth: true
            },
        },
        {
            path: "/admin/manage-coupon",
            name: "Coupon",
            component: ManageCoupon,
            meta: {
                requiresAuth: true
            },
        },
        {
            path: "/admin/manage-orders",
            name: "Order",
            component: ManageOrder,
            meta: {
                requiresAuth: true
            },
        },
        {
            path: "/admin/order-details/:id",
            name: "Order Details",
            component: OrderDetails,
            meta: {
                requiresAuth: true
            }
        },

    ]
})

router.beforeEach((to, from, next) => {
    const adminLoggedIn = localStorage.getItem('admin')

    if (to.matched.some(record => record.meta.requiresAuth) && !adminLoggedIn)
        next({
            name: 'Admin Login',
            params: {
                nextUrl: to.fullPath
            }
        })
    else if (to.matched.some(record => record.meta.guest) && adminLoggedIn) {
        next({
            name: 'Admin Dashboard'
        })

    } else

        next()
})

export default router
