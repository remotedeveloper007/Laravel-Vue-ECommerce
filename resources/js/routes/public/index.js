import Vue from "vue";
import VueRouter from "vue-router";
// import axios from 'axios';

Vue.use(VueRouter);

import PublicHome from "../../components/public/PublicHome.vue";
import SingleProduct from "../../components/public/pages/SingleProduct.vue";
import Cart from "../../components/public/pages/Cart.vue";
import Contact from "../../components/public/pages/Contact.vue";

// import SubcatProduct from '../components/public/pages/SubCategoryProduct.vue';
// import NotFound from "../../components/public/pages/NotFound.vue";

import UserLogin from "../../components/user/Auth/Login.vue";
import UserRegister from "../../components/user/Auth/Register.vue";
import UserDashboard from "../../components/user/Profile.vue";
import EditProfile from "../../components/user/EditProfile.vue";
import ChangePassword from "../../components/user/ChangePassword.vue";
import MyOrder from "../../components/user/MyOrder.vue";
import OrderDetails from "../../components/user/OrderDetails.vue";
import MyWishlist from "../../components/user/MyWishlist.vue";
import CheckOut from "../../components/user/CheckOut.vue";
import ReviewOrder from "../../components/user/ReviewOrder.vue";
import Thanks from "../../components/user/Thanks.vue";
import Paypal from "../../components/user/Paypal.vue";

let router = new VueRouter({
    mode: "history",

    routes: [
        /**
         * Shop Frontend for general user
         */
        {
            path: "/",
            name: "Home",
            component: PublicHome
        },
        {
            path: "/category-products/:url",
            component: PublicHome
        },
        {
            path: "/subcategory-products/:url",
            component: PublicHome
        },
        {
            path: "/single-product/:id",
            component: SingleProduct
        },
        {
            path: "/cart",
            name: "cart",
            component: Cart
        },
        {
            path: "/contact",
            component: Contact
        },

        // {
        //     path: '/:pathMatch(.*)*',
        //     component: NotFound,
        // },

        /**
         * Shop Frontend UI for User Login, Rgister and Profile dashboard
         */
        {
            path: "/user-login",
            name: "login",
            component: UserLogin,
            meta: {
                guest: true
            }
        },
        {
            path: "/user-register",
            name: "register",
            component: UserRegister,
            meta: {
                guest: true
            }
        },

        {
            path: "/password/email",
            name: "Reset Password",
            component: () => import("../../components/user/Auth/passwords/Email.vue"),
            meta: {
                guest: true
            }
        },

        {
            path: "/email/verify",
            name: "Verify Email",
            component: () => import("../../components/user/Email/Verify.vue"),
            meta: {
                guest: true
            }
        },

        {
            path: '/email/already/verified',
            name: 'Already Verified',
            component: () => import("../../components/user/Email/AlreadyVerified.vue"),
            meta: {
                guest: true
            }
        },

        {
            path: '/email/verify/success',
            name: 'Verify Success',
            component: () => import("../../components/user/Email/VerifySuccess.vue"),
            meta: {
                guest: true
            }
        },

        {
            path: '/email/verify/failed',
            name: 'Verify Failed',
            component: () => import("../../components/user/Email/VerifyFailed.vue"),
            meta: {
                guest: true
            }
        },
        /**
         * Shop Frontend UI for User after Authentication Profile dashboard
         */
        {
            path: "/user/dashboard",
            name: "dashboard",
            component: UserDashboard,
            props: true,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/user/edit-profile/:id",
            name: "editprofile",
            component: EditProfile,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/user/change-password/:id",
            name: "changepassword",
            component: ChangePassword,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/user/my-order/:id",
            name: "myorder",
            component: MyOrder,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/user/order-details/:id",
            name: "Order Details",
            component: OrderDetails,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/user/my-wishlist/:id",
            name: "mywishlist",
            component: MyWishlist,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/user/checkout",
            name: "checkout",
            component: CheckOut,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/user/review-order",
            name: "Review Order",
            component: ReviewOrder,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/user/thanks",
            name: "Thanks",
            component: Thanks,
            meta: {
                requiresAuth: true
            }
        },
        {
            path: "/user/payment-status",
            name: "Paypal Status",
            component: Paypal,
            meta: {
                requiresAuth: true
            }
        }
    ]
});

router.beforeEach((to, from, next) => {
    //localStorage.getItem('user')/ axios.defaults.headers.common["Authorization"]
    const userLoggedIn = localStorage.getItem('user')

    if (to.matched.some(record => record.meta.requiresAuth) && !userLoggedIn)
        next({
            name: "login",
            params: {
                nextUrl: to.fullPath
            }
        });
    else if (to.matched.some(record => record.meta.guest) && userLoggedIn) {
        next({
            name: "dashboard"
        });
    } else next();
});

export default router;
