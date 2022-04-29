<template>
  <div>
    <header>
      <!--header-->
      <div class="header_top">
        <!--header_top-->
        <div class="container">
          <div class="row">
            <div class="col-sm-6">
              <div class="contactinfo">
                <ul class="nav nav-pills">
                  <li>
                    <a href="#">
                      <i class="fa fa-phone"></i> +2 95 01 88 821
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-envelope"></i> info@domain.com
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="social-icons pull-right">
                <ul class="nav navbar-nav">
                  <li>
                    <a href="#">
                      <i class="fa fa-facebook"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-twitter"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-linkedin"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-dribbble"></i>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-google-plus"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/header_top-->

      <div class="header-middle">
        <!--header-middle-->
        <div class="container">
          <div class="row">
            <div class="col-sm-4">
              <div class="logo pull-left">
                <a href="/">
                  <img src="/assets/public/images/home/logo.png" alt />
                </a>
              </div>
              <div class="btn-group pull-right">
                <div class="btn-group">
                  <button
                    type="button"
                    class="btn btn-default dropdown-toggle usa"
                    data-toggle="dropdown"
                  >
                    USA
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#">Canada</a>
                    </li>
                    <li>
                      <a href="#">UK</a>
                    </li>
                  </ul>
                </div>

                <div class="btn-group">
                  <button
                    type="button"
                    class="btn btn-default dropdown-toggle usa"
                    data-toggle="dropdown"
                  >
                    DOLLAR
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#">Canadian Dollar</a>
                    </li>
                    <li>
                      <a href="#">Pound</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="shop-menu pull-right">
                <ul class="nav navbar-nav">
                  <li>
                    <router-link :to="{ name: 'dashboard' }">
                      <i class="fa fa-user"></i> Account
                    </router-link>
                  </li>
                  <!-- <li>
                    <router-link :to="{ name: 'mywishlist'}">
                      <i class="fa fa-star"></i> My Wishlist
                    </router-link>
                  </li> -->
                  <li>
                    <router-link :to="{ name: 'checkout' }">
                      <i class="fa fa-crosshairs"></i> Checkout
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'cart' }">
                      <i class="fa fa-shopping-cart"></i> Cart
                    </router-link>
                  </li>
                  <li>
                    <router-link :to="{ name: 'login' }">
                      <i class="fa fa-lock"></i> Login
                    </router-link>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/header-middle-->

      <div class="header-bottom sticky" id="myHeader">
        <!--header-bottom-->
        <div class="container">
          <nav>
            <div class="row justify-content-center">
              <div></div>
              <div class="col-sm-12">
                <!--       <div class="navbar-header">
                  <button
                    type="button"
                    class="navbar-toggle"
                    data-toggle="collapse"
                    data-target=".navbar-collapse"
                  >
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>-->
                <!--   class="mainmenu pull-left"  -->
                <div class="mainmenu">
                  <ul id="nav" class="nav navbar-nav collapse navbar-collapse">
                    <li>
                      <a href="/" class="active">Home</a>
                    </li>
                    <li class="dropdown">
                      <a href="#">
                        Categories
                        <i class="fa fa-angle-down"></i>
                      </a>
                      <ul role="menu" class="sub-menu">
                        <li v-for="category in getcategory" :key="category.id">
                          <router-link
                            :to="`/category-products/${category.url}`"
                            >{{ category.name }}</router-link
                          >
                        </li>
                        <!-- @endforeach -->
                        <!-- <li><a href="shop.html">Products</a></li>
											<li><a href="product-details.html">Product Details</a></li> 
											<li><a href="checkout.html">Checkout</a></li> 
											<li><a href="cart.html">Cart</a></li> 
                        <li><a href="login.html">Login</a></li>-->
                      </ul>
                    </li>
                    <li class="dropdown">
                      <a href="#">
                        Blog
                        <i class="fa fa-angle-down"></i>
                      </a>
                      <ul role="menu" class="sub-menu">
                        <li>
                          <a href="blog.html">Blog List</a>
                        </li>
                        <li>
                          <a href="blog-single.html">Blog Single</a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="404.html">404</a>
                    </li>
                    <li class="menu__item dropdown">
                      <a
                        class="menu__link dropdown-toggle"
                        href="#"
                        data-toggle="dropdown"
                      >
                        Short Codes
                        <b class="caret"></b>
                      </a>
                      <ul class="dropdown-menu agile_short_dropdown">
                        <li>
                          <a href="icons.html">Web Icons</a>
                        </li>
                        <li>
                          <a href="typography.html">Typography</a>
                        </li>
                      </ul>
                    </li>
                    <li>
                      <a href="/contact">Contact</a>
                    </li>
                  </ul>
                </div>

                <!-- Header Icon -->
                <div class="header-icons pull-right">
                  <router-link
                    :to="{ name: 'login' }"
                    class="header-wrapicon1 dis-block"
                  >
                    <img
                      src="/assets/public/images/header/icon-header-01.png"
                      class="header-icon1"
                      alt="ICON"
                    />
                    My Account
                  </router-link>
                  <!-- </span> -->
                  <span class="linedivide1"></span>

                  <div class="header-wrapicon2">
                    <img
                      src="/assets/public/images/header/icon-header-02.png"
                      class="header-icon1 js-show-header-dropdown"
                      alt="ICON"
                    />
                    <span class="header-icons-noti">0</span>

                    <!-- Header cart noti -->
                    <div class="header-cart header-dropdown">
                      <ul class="header-cart-wrapitem">
                        <li class="header-cart-item">
                          <div class="header-cart-item-img">
                            <img src="images/item-cart-01.jpg" alt="IMG" />
                          </div>

                          <div class="header-cart-item-txt">
                            <a href="#" class="header-cart-item-name"
                              >White Shirt With Pleat Detail Back</a
                            >

                            <span class="header-cart-item-info"
                              >1 x $19.00</span
                            >
                          </div>
                        </li>

                        <li class="header-cart-item">
                          <div class="header-cart-item-img">
                            <img src="images/item-cart-02.jpg" alt="IMG" />
                          </div>

                          <div class="header-cart-item-txt">
                            <a href="#" class="header-cart-item-name"
                              >Converse All Star Hi Black Canvas</a
                            >

                            <span class="header-cart-item-info"
                              >1 x $39.00</span
                            >
                          </div>
                        </li>

                        <li class="header-cart-item">
                          <div class="header-cart-item-img">
                            <img src="images/item-cart-03.jpg" alt="IMG" />
                          </div>

                          <div class="header-cart-item-txt">
                            <a href="#" class="header-cart-item-name"
                              >Nixon Porter Leather Watch In Tan</a
                            >

                            <span class="header-cart-item-info"
                              >1 x $17.00</span
                            >
                          </div>
                        </li>
                      </ul>

                      <div class="header-cart-total">Total: $75.00</div>

                      <div class="header-cart-buttons">
                        <div class="header-cart-wrapbtn">
                          <!-- Button -->
                          <a
                            href="cart.html"
                            class="
                              flex-c-m
                              size1
                              bg1
                              bo-rad-20
                              hov1
                              s-text1
                              trans-0-4
                            "
                            >View Cart</a
                          >
                        </div>

                        <div class="header-cart-wrapbtn">
                          <!-- Button -->
                          <a
                            href="#"
                            class="
                              flex-c-m
                              size1
                              bg1
                              bo-rad-20
                              hov1
                              s-text1
                              trans-0-4
                            "
                            >Check Out</a
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- //Header Icon -->
              </div>

              <div>
                <!-- Header Icon -->

                <!--
                      <div class="search_box pull-right">
                            <input type="text" class="form-control" placeholder="Search"/>  
                </div>-->
              </div>
            </div>
          </nav>
        </div>
      </div>
      <!--/header-bottom-->
    </header>

    <!--/header-->
  </div>
</template>


<script>
export default {
  data() {
    return {
      id: "",
      name: "",
      username: "",
    };
  },

  mounted() {
    /**
     *
     */
    this.$store.dispatch("fetchAllCategories");
    // this.authUser();
    /**
     * jquery function to strick at top
     */
    $(document).ready(function () {
      $(window).scroll(function () {
        if ($(this).scrollTop() > 1) {
          $("#myHeader").addClass("sticky");
        } else {
          $("#myHeader").removeClass("sticky");
        }
      });

      /**
       * jquery for js-headerdropdown
       */
      /*[ Show header dropdown ]
            ===========================================================*/
      $(".js-show-header-dropdown").on("click", function () {
        $(this).parent().find(".header-dropdown");
      });

      var menu = $(".js-show-header-dropdown");
      var sub_menu_is_showed = -1;

      for (var i = 0; i < menu.length; i++) {
        $(menu[i]).on("click", function () {
          if (jQuery.inArray(this, menu) == sub_menu_is_showed) {
            $(this)
              .parent()
              .find(".header-dropdown")
              .toggleClass("show-header-dropdown");
            sub_menu_is_showed = -1;
          } else {
            for (var i = 0; i < menu.length; i++) {
              $(menu[i])
                .parent()
                .find(".header-dropdown")
                .removeClass("show-header-dropdown");
            }

            $(this)
              .parent()
              .find(".header-dropdown")
              .toggleClass("show-header-dropdown");
            sub_menu_is_showed = jQuery.inArray(this, menu);
          }
        });
      }

      $(".js-show-header-dropdown, .header-dropdown").click(function (event) {
        event.stopPropagation();
      });

      $(window).on("click", function () {
        for (var i = 0; i < menu.length; i++) {
          $(menu[i])
            .parent()
            .find(".header-dropdown")
            .removeClass("show-header-dropdown");
        }
        sub_menu_is_showed = -1;
      });

      /*[ End of Show header dropdown ]
        ===========================================================*/
    });
  },

  computed: {
    getcategory() {
      return this.$store.getters.getCategories;
    },
  },
  created() {},
  methods: {},

  watch: {
    $route(to, from) {},
  },
};
</script>


<style scoped>
strong {
  font-size: 18px;
}
#loguser {
  margin-left: 5px;
}
#nav {
  margin-left: 200px;
}
.header-bottom {
  padding-bottom: 15px;
  padding-top: 20px;
  background-color: #f0f0e9;
  color: #fda30e;
  line-height: 1.42857143;
  position: relative;
  z-index: 1;
}

.sticky {
  position: -webkit-sticky;
  position: fixed;
  top: 0;
  width: 100%;
  /*	 transition: 1s;  */
}

.sticky + .slider {
  padding-top: 50px;
}
#logout {
  margin-top: 10px;
  cursor: pointer;
}

.linedivide1 {
  display: block;
  height: 20px;
  width: 1px;
  background-color: #7c7575;
  margin-left: 23px;
  margin-right: 23px;
  margin-top: 5px;
}

.header-cart-wrapitem {
  max-height: 270px;
  overflow: auto;
}

.show-header-dropdown {
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  -o-transform: scale(1);
  transform: scale(1);
}

.header-cart {
  position: absolute;
  z-index: 1100;
  width: 339px;
  top: 190%;
  right: -10px;
  padding: 20px;
  border-top: 3px solid #e6e6e6;
  background-color: white;
  box-shadow: 0 3px 5px 0px rgba(0, 0, 0, 0.1);
  -moz-box-shadow: 0 3px 5px 0px rgba(0, 0, 0, 0.1);
  -webkit-box-shadow: 0 3px 5px 0px rgba(0, 0, 0, 0.1);
  -o-box-shadow: 0 3px 5px 0px rgba(0, 0, 0, 0.1);
  -ms-box-shadow: 0 3px 5px 0px rgba(0, 0, 0, 0.1);
  transition: all 0.3s;
  -webkit-transition: all 0.3s;
  -o-transition: all 0.3s;
  -moz-transition: all 0.3s;
  transform-origin: top right;
  -webkit-transform: scale(0);
  -moz-transform: scale(0);
  -ms-transform: scale(0);
  -o-transform: scale(0);
  transform: scale(0);
}
.header-cart-item {
  display: -webkit-box;
  display: -webkit-flex;
  display: -moz-box;
  display: -ms-flexbox;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  padding-bottom: 5px;
  padding-top: 5px;
}

ul li {
  list-style: none;
}
</style>