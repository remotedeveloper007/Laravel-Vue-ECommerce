import Form from 'vform';
<template>
  <div>
    <span v-if="token"><Header :username="myProfile.name" /></span>
    <span v-else><Header /></span>
    <!--===============================================================================================-->
    <!-- banner -->
    <div class="page-head">
      <div class="container">
        <!-- <h5><div class="breadcrumbs">
          <ol class="breadcrumb">
            <li>
              <a href="/">Home</a><i class="fa fa-angle-right"></i>&nbsp;
            </li>
            <li class="active">Product Details</li>
          </ol>
        </div></h5>-->
        <h3>Product Details</h3>
      </div>
    </div>
    <br />
    <br />

    <!-- //banner -->
    <!--===============================================================================================-->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div class="left-sidebar">
              <Category />
              <!--/category-products-->
              <!--===============================================================================================-->

              <Brand />
              <!--/brands_products-->
              <!--===============================================================================================-->
              <PriceRange />
              <!--/price-range-->
              <!--===============================================================================================-->
              <div class="shipping text-center">
                <!--shipping-->
                <img src="/assets/public/images/home/shipping.jpg" alt />
              </div>
              <!--/shipping-->
            </div>
          </div>

          <div class="col-sm-9 padding-right">
            <div class="product-details">
              <!--product-details-->
              <div class="col-sm-5">
                <div class="view-product">
                  <img
                    :src="`/product_image/${singleProduct.product_image}`"
                    alt
                    data-imagezoom="true"
                    class="mainImage"
                  />
                  <h3>ZOOM</h3>
                </div>
                <div
                  id="similar-product"
                  class="carousel slide"
                  data-ride="carousel"
                >
                  <!-- Wrapper for slides -->
                  <div class="carousel-inner">
                    <div class="item active">
                      <span id="img1">
                        <img
                          class="changeImage"
                          :src="`/product_image/${singleProduct.product_image}`"
                          width="80"
                          height="80"
                          alt
                        />
                      </span>
                      <span>
                        <img
                          class="changeImage"
                          :src="`/product_image/${singleProduct.alternate_image1}`"
                          width="80"
                          height="80"
                          alt
                        />
                      </span>
                      <span>
                        <img
                          class="changeImage"
                          :src="`/product_image/${singleProduct.alternate_image2}`"
                          width="80"
                          height="80"
                          alt
                        />
                      </span>
                    </div>
                    <div class="item">
                      <span id="slise2">
                        <img
                          class="changeImage"
                          :src="`/product_image/${singleProduct.alternate_image1}`"
                          width="80"
                          height="80"
                          alt
                        />
                      </span>
                      <span>
                        <img
                          class="changeImage"
                          :src="`/product_image/${singleProduct.alternate_image2}`"
                          width="80"
                          height="80"
                          alt
                        />
                      </span>
                      <span>
                        <img
                          class="changeImage"
                          :src="`/product_image/${singleProduct.product_image}`"
                          width="80"
                          height="80"
                          alt
                        />
                      </span>
                    </div>
                    <div class="item">
                      <span>
                        <img
                          class="changeImage"
                          :src="`/product_image/${singleProduct.alternate_image2}`"
                          width="80"
                          height="80"
                          alt
                        />
                      </span>
                      <span>
                        <img
                          class="changeImage"
                          :src="`/product_image/${singleProduct.product_image}`"
                          width="80"
                          height="80"
                          alt
                        />
                      </span>
                      <span>
                        <img
                          class="changeImage"
                          :src="`/product_image/${singleProduct.alternate_image1}`"
                          width="80"
                          height="80"
                          alt
                        />
                      </span>
                    </div>
                  </div>

                  <!-- Controls -->
                  <a
                    class="left item-control"
                    href="#similar-product"
                    data-slide="prev"
                  >
                    <i class="fa fa-angle-left"></i>
                  </a>
                  <a
                    class="right item-control"
                    href="#similar-product"
                    data-slide="next"
                  >
                    <i class="fa fa-angle-right"></i>
                  </a>
                </div>
              </div>
              <div class="col-sm-7">
                <form
                  v-on:submit.prevent="addToCart()"
                  enctype="multipart/form-data"
                >
                  <div class="product-information">
                    <!--/product-information-->
                    <!-- <img src="/assets/public/images/product-details/new.jpg" class="newarrival" alt /> -->
                    <h2 id="title">{{ singleProduct.product_name }}</h2>
                    <p id="code">
                      Product Code: {{ singleProduct.product_code }}
                    </p>
                    <img
                      src="/assets/public/images/product-details/rating.png"
                      alt
                    />
                    <br />
                    <input type="hidden" name="_token" :value="csrf" />
                    <!-- <input type="hidden" name="product_name" id="title" v-model="form.product_name"/>
                    <input type="hidden" name="product_code" id="code" v-model="form.product_code"/>-->

                    <div id="select">
                      <label class="col-sm-2">Size:</label>
                      <select
                        id="size"
                        v-model="form.size"
                        class="col-sm-10"
                        @change="getPrice()"
                        :class="{ 'is-invalid': form.errors.has('size') }"
                        autofocus
                      >
                        <option disabled value>Select Size</option>
                        <template v-for="attribute in proAttributes">
                          <template
                            v-if="singleProduct.id == attribute.product_id"
                          >
                            <option
                              :key="attribute.d"
                              :value="
                                attribute.product_id + '/' + attribute.size
                              "
                              :selected="true"
                            >
                              {{ attribute.size }}
                            </option>
                          </template>
                        </template>
                      </select>
                      <has-error
                        :form="form"
                        field="size"
                        class="invalid-feedback"
                        role="alert"
                      ></has-error>
                    </div>
                    <br />
                    <div class="occasional">
                      <h5>Color :</h5>
                      <div class="colr ert">
                        <label class="radio">
                          <input
                            type="radio"
                            name="product_color"
                            id="red"
                            v-model="form.product_color"
                          />
                          <i class="red"></i>Red
                        </label>
                      </div>
                      <div class="colr">
                        <label class="radio">
                          <input
                            type="radio"
                            name="product_color"
                            id="blue"
                            v-model="form.product_color"
                          />
                          <i class="blue"></i>Blue
                        </label>
                      </div>
                      <div class="colr">
                        <label class="radio">
                          <input
                            type="radio"
                            name="product_color"
                            id="green"
                            v-model="form.product_color"
                          />
                          <i class="green"></i>Green
                        </label>
                      </div>
                      <div class="colr">
                        <label class="radio">
                          <input
                            type="radio"
                            name="product_color"
                            id="white"
                            v-model="form.product_color"
                          />
                          <i class="white"></i>White
                        </label>
                      </div>
                      <div class="colr">
                        <label class="radio">
                          <input
                            type="radio"
                            name="product_color"
                            id="yellow"
                            v-model="form.product_color"
                          />
                          <i class="yellow"></i>Yellow
                        </label>
                      </div>
                      <div class="colr">
                        <label class="radio">
                          <input
                            type="radio"
                            name="product_color"
                            id="black"
                            v-model="form.product_color"
                          />
                          <i class="black"></i>Black
                        </label>
                      </div>
                      <div class="clearfix"></div>
                    </div>
                    <span>
                      <span v-if="proPrice.size != null"
                        >US $ {{ proPrice.price }}</span
                      >
                      <span v-else>US $ {{ singleProduct.product_price }}</span>

                      <label>Quantity:</label>
                      <input
                        v-model="form.quantity"
                        name="quantity"
                        type="text"
                        id="qty"
                        placeholder="1"
                      />
                      <template
                        v-if="proPrice.size != null && proPrice.stock > 0"
                      >
                        <button
                          type="submit"
                          class="btn btn-fefault cart"
                          id="cartbtn"
                        >
                          <i class="fa fa-shopping-cart"></i>
                          Add to cart
                        </button>
                      </template>
                      <template v-if="proStock > 0 && proPrice.size == null">
                        <button
                          type="submit"
                          class="btn btn-fefault cart"
                          id="cartbtn"
                        >
                          <i class="fa fa-shopping-cart"></i>
                          Add to cart
                        </button>
                      </template>
                    </span>
                    <!-- //Form end -->
                    <p>
                      <b>Availability:</b>
                      <i
                        id="in"
                        v-if="proPrice.size != null && proPrice.stock > 0"
                        >In Stock</i
                      >
                      <i
                        id="out"
                        v-else-if="proPrice.size != null && proPrice.stock == 0"
                        >Out Of Stock</i
                      >
                      <i id="in" v-else-if="proStock > 0">In Stock</i>
                      <i id="out" v-else-if="proStock == 0">Out Of Stock</i>
                      <!-- <i id="in" v-if="proStock > 0">In Stock</i><i id="out" v-else>Out Of Stock</i>                   -->
                    </p>

                    <p>
                      <b v-if="proPrice.size">Stock: {{ proPrice.stock }}</b>
                    </p>

                    <p><b>Brand:</b> E-SHOPPER</p>
                    <!-- <a href>
                    <img src="/assets/public/images/product-details/share.png" class="share img-responsive" alt />
                    </a>-->
                    <ul
                      class="
                        social-nav
                        model-3d-0
                        footer-social
                        w3_agile_social
                        single_page_w3ls
                      "
                    >
                      <li class="share">Share On :</li>
                      <li>
                        <a href="#" class="facebook">
                          <div class="front">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                          </div>
                          <div class="back">
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="twitter">
                          <div class="front">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                          </div>
                          <div class="back">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="instagram">
                          <div class="front">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                          </div>
                          <div class="back">
                            <i class="fa fa-instagram" aria-hidden="true"></i>
                          </div>
                        </a>
                      </li>
                      <li>
                        <a href="#" class="pinterest">
                          <div class="front">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                          </div>
                          <div class="back">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                </form>
                <!--/product-information-->
              </div>
            </div>
            <!--/product-details-->

            <div class="category-tab shop-details-tab">
              <!--category-tab-->
              <div class="col-sm-12">
                <ul class="nav nav-tabs">
                  <li class="active">
                    <a href="#descriptions" data-toggle="tab">Descriptions</a>
                  </li>
                  <li>
                    <a href="#care" data-toggle="tab">Care</a>
                  </li>
                  <li>
                    <a href="#delivery" data-toggle="tab">Delivery Options</a>
                  </li>
                  <li>
                    <a href="#reviews" data-toggle="tab">Reviews (5)</a>
                  </li>
                </ul>
              </div>
              <div class="tab-content">
                <div class="tab-pane fade active in" id="descriptions">
                  <div class="col-sm-12">
                    <p>{{ singleProduct.description }}</p>
                  </div>
                </div>

                <div class="tab-pane fade" id="care">
                  <div class="col-sm-12">
                    <p>{{ singleProduct.care }}</p>
                  </div>
                </div>

                <div class="tab-pane fade" id="delivery">
                  <div class="col-sm-12">
                    <p>Delivery Options</p>
                  </div>
                </div>

                <div class="tab-pane fade" id="tag">
                  <div class="col-sm-3">
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                          <img
                            src="/assets/public/images/home/gallery1.jpg"
                            alt
                          />
                          <h2>$56</h2>
                          <p>Easy Polo Black Edition</p>
                          <button
                            type="button"
                            class="btn btn-default add-to-cart"
                          >
                            <i class="fa fa-shopping-cart"></i>Add to cart
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                          <img
                            src="/assets/public/images/home/gallery2.jpg"
                            alt
                          />
                          <h2>$56</h2>
                          <p>Easy Polo Black Edition</p>
                          <button
                            type="button"
                            class="btn btn-default add-to-cart"
                          >
                            <i class="fa fa-shopping-cart"></i>Add to cart
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                          <img
                            src="/assets/public/images/home/gallery3.jpg"
                            alt
                          />
                          <h2>$56</h2>
                          <p>Easy Polo Black Edition</p>
                          <button
                            type="button"
                            class="btn btn-default add-to-cart"
                          >
                            <i class="fa fa-shopping-cart"></i>Add to cart
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="product-image-wrapper">
                      <div class="single-products">
                        <div class="productinfo text-center">
                          <img
                            src="/assets/public/images/home/gallery4.jpg"
                            alt
                          />
                          <h2>$56</h2>
                          <p>Easy Polo Black Edition</p>
                          <button
                            type="button"
                            class="btn btn-default add-to-cart"
                          >
                            <i class="fa fa-shopping-cart"></i>Add to cart
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="reviews">
                  <div class="col-sm-12">
                    <ul>
                      <li>
                        <a href> <i class="fa fa-user"></i>EUGEN </a>
                      </li>
                      <li>
                        <a href> <i class="fa fa-clock-o"></i>12:41 PM </a>
                      </li>
                      <li>
                        <a href>
                          <i class="fa fa-calendar-o"></i>31 DEC 2014
                        </a>
                      </li>
                    </ul>
                    <p>
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                      sed do eiusmod tempor incididunt ut labore et dolore magna
                      aliqua.Ut enim ad minim veniam, quis nostrud exercitation
                      ullamco laboris nisi ut aliquip ex ea commodo
                      consequat.Duis aute irure dolor in reprehenderit in
                      voluptate velit esse cillum dolore eu fugiat nulla
                      pariatur.
                    </p>
                    <p>
                      <b>Write Your Review</b>
                    </p>

                    <form action="#">
                      <span>
                        <input type="text" placeholder="Your Name" />
                        <input type="email" placeholder="Email Address" />
                      </span>
                      <textarea name></textarea>
                      <b>Rating:</b>
                      <img
                        src="/assets/public/images/product-details/rating.png"
                        alt
                      />
                      <button type="button" class="btn btn-default pull-right">
                        Submit
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!--/category-tab-->
            <!--==================================================== recommendedItems ===========================================-->
            <!-- <RecommendedItems > -->
            <div class="recommended_items">
              <!--recommended_items-->
              <h2 class="title text-center">recommended items</h2>

              <div
                id="recommended-item-carousel"
                class="carousel slide"
                data-ride="carousel"
              >
                <carousel-3d
                  :autoplay="true"
                  :autoplay-timeout="3000"
                  :display="3"
                  :count="recommendedItems.length"
                >
                  <slide
                    id="single-products"
                    v-for="(product, i) in recommendedItems"
                    :index="i"
                    :key="i"
                  >
                    <!-- Wrapper for slides -->

                    <div class="carousel-inner">
                      <div class="item active">
                        <!-- <div class="col-sm-4"> -->
                        <div class="product-image-wrapper">
                          <div class="single-products">
                            <div class="productinfo text-center">
                              <img
                                :src="productImage(product.product_image)"
                                class="changeImage"
                                :alt="product.title"
                                width="88"
                                height="120"
                              />
                              <h2>$ {{ product.product_price }}</h2>
                              <p>{{ product.product_name }}</p>
                              <a href="#" class="btn btn-default add-to-cart">
                                <i class="fa fa-shopping-cart"></i>Add to cart
                              </a>
                            </div>
                          </div>
                        </div>
                        <!-- </div> -->
                      </div>
                    </div>
                    <!-- //Wrapper for slides -->
                  </slide>
                </carousel-3d>

                <a
                  class="left recommended-item-control"
                  href="#recommended-item-carousel"
                  data-slide="prev"
                >
                  <i class="fa fa-angle-left"></i>
                </a>
                <a
                  class="right recommended-item-control"
                  href="#recommended-item-carousel"
                  data-slide="next"
                >
                  <i class="fa fa-angle-right"></i>
                </a>
              </div>
            </div>
            <!--/recommended_items-->
            <!--===============================================================================================-->
          </div>
        </div>
      </div>
    </section>
    <!--===============================================================================================-->
  </div>
</template>

<script>
import { Carousel3d, Slide } from "vue-carousel-3d";
import Form from "vform";
// import carousel from "vue-owl-carousel";
import Header from "../header/header.vue";
// import RecommendedItems from "../bodycontent/RecommendedItems.vue";
import Category from "../leftsidebar/Category.vue";
import Brand from "../leftsidebar/Brand.vue";
import PriceRange from "../leftsidebar/PriceRange.vue";
export default {
  components: {
    Header,
    // RecommendedItems,
    /**
     * LeftSidebar
     */
    Category,
    Brand,
    PriceRange,
    // carousel,
    Carousel3d,
    Slide,
  },

  data() {
    return {
      token: axios.defaults.headers.common["Authorization"],
      csrf: "",
      id: [],
      product_id: [],
      proAttributes: [],
      recommendedItems: [],
      getProduct: [],
      proPrice: "",
      proStock: "",
      cartItems: [],
      proQty: [],
      form: new Form({
        // csrf: document.querySelector('meta[name="csrf-token"]'),
        // .getAttribute("content"),
        product_id: "",
        product_name: "",
        product_code: "",
        product_color: "",
        size: "",
        price: "",
        quantity: "",
      }),
    };
  },

  computed: {
    singleProduct() {
      //taken from resources/js/store/index.js/getters:getSingleProduct
      return this.$store.getters.getSingleProduct;
    },
    myProfile() {
      return this.$store.getters.getProfile;
    },
    // productChunks() {
    //   return _.chunk(_.toArray(this.recommendedItems),3);
    // }
  },

  methods: {
    productImage(img) {
      return "/product_image/" + img;
    },
    singleproduct() {
      //taken from resources/js/store/index.js/actions/fetchSingleproduct
      this.$store.dispatch("fetchSingleproduct", this.$route.params.id);
    },
    getAttributes() {
      axios.get(`/proAttribute/${this.$route.params.id}`).then((response) => {
        this.proAttributes = response.data.attributes;
      });
    },
    getPrice() {
      axios.get("/price/" + this.form.size).then((response) => {
        this.proPrice = response.data.price;
        this.form.fill(this.proPrice);
      });
    },
    getStock() {
      axios
        .get(`/check-stock/${this.$route.params.id}` + this.form.size)
        .then((response) => {
          this.proStock = response.data.stock;
        });
    },
    fetchRecommendedItems() {
      axios.get(`/productDetails/${this.$route.params.id}`).then((response) => {
        this.recommendedItems = response.data.recommendedProducts;
        // this.recommendedItems = _.chunk(_.toArray(response.data.recommendedProducts), 3);
      });
    },
    /**
     *  Add Product to Cart
     */
    addToCart() {
      this.form
        .post(`/api/add-to-cart/${this.$route.params.id}`)
        .then((response) => {
          this.cartItems = response.data.cartItems;
          this.proQty = response.data.stock;
          if (this.cartItems > 0) {
            this.$router.push(`/single-product/${this.$route.params.id}`);
            Swal.fire({
              icon: "warning",
              text: "This product already exist in your cart.",
            });
            // } else if (this.proQty < form.quantity) {
            //   this.$router.push(`/single-product/${this.$route.params.id}`);
            //   Swal.fire({
            //     icon: "warning",
            //     text: "Insufficient quantity available in stock."
            //   });
          } else {
            this.$router.push("/cart");
            Swal.fire(
              "Congratulation!",
              "Product Added To Cart Successfully.",
              "success"
            );
          }
        })
        .catch(() => {});
    },
  },

  mounted() {
    this.$store.dispatch("myProfile");
    this.singleproduct();
    this.getAttributes();
    this.getStock();
    this.fetchRecommendedItems();
    // this.form.fill(attributes);
    // this.$store.dispatch("getAttributes");

    $(document).ready(function () {
      $(".changeImage").click(function () {
        var image = $(this).attr("src");
        $(".mainImage").attr("src", image);
      });
    });
  },

  // created() {
  //   this.getAttributes();
  // },

  watch: {
    $route(to, from) {
      this.singleProduct();
    },
  },
};
</script>

<style lang="scss">
.page-head h3 {
  font-size: 28px;
}

#select {
  margin-top: 10px;
  margin-left: -15px;
  font-size: 16px;
  width: 80%;
}

#color {
  size: 20px;
  margin-top: 5px;
}

#img1 {
  margin-left: 15px;
}

#slise2 {
  margin-left: 7px;
}

// .carousel-3d-slide {
//   padding: 20px;
// }

#in {
  font-weight: bolder;
  color: green;
}
#out {
  font-weight: bold;
  color: red;
}
#qty {
  width: 40px;
  background: white;
  border: 1px solid black;
  font-size: 18px;
}
</style>