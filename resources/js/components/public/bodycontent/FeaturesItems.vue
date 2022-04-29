<template>
  <div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">
      <template v-if="this.$route.params.url == null"> Features Products </template>
      <template v-else-if="this.$route.params.url === 0">{{ this.$route.params.url }}</template>
      <template v-else-if="this.$route.params.url !== 0">{{ this.$route.params.url }}</template>
  </h2>

    <div v-for="product in featureProduct" :key="product.id" class="col-sm-4">
      <div class="product-image-wrapper">
        <div class="single-products">
          <div class="productinfo text-center">
            <img :src="productImage(product.product_image)" alt width="100" />
            <h2>${{product.product_price}}</h2>
            <p>{{product.product_name}}</p>
            <a href="#" class="btn btn-default add-to-cart">
              <i class="fa fa-shopping-cart"></i>Add to cart
            </a>
          </div>
          <div class="product-overlay">
            <div class="overlay-content">
              <img :src="productImage(product.product_image)" alt />
              <h2>${{product.product_price}}</h2>
              <p>{{product.product_name}}</p>
              <a :href="`/single-product/${product.id}`" id="detail" class="btn btn-default add-to-cart">
                <i class="fa fa-eye"></i>Details
              </a>
              <a href="#" class="btn btn-default add-to-cart">
                <i class="fa fa-shopping-cart"></i>Add to cart
              </a>
            </div>
          </div>
        </div>
        <div class="choose">
          <ul class="nav nav-pills nav-justified">
            <li>
              <a href="#">
                <i class="fa fa-plus-square"></i>Add to wishlist
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-plus-square"></i>Add to compare
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!--features_items-->
</template>

<script>
export default {
  name: "FeatureProduct",
  data() {
    return { id: [] };
  },

  mounted() {
    this.$store.dispatch("fetchAllProduct");
    // this.getAllCatProduct()
  },

  computed: {
    featureProduct() {
      return this.$store.getters.getProducts;
    }
  },
  methods: {
    productImage(img) {
      return "/product_image/" + img;
    },

    // getSubcatProduct() {
    //   if (this.$route.params.url) {
    //     this.$store.dispatch("fetchSubcatPro", this.$route.params.url);
    //   } else {
    //     return this.$store.dispatch("fetchAllProduct");
    //   }
    // },   
     
     getAllCatProduct() {
       if(this.$route.params.url) {
           this.$store.dispatch('fetchCatPro', this.$route.params.url)
       } else if (this.$route.params.url) {
           this.$store.dispatch('fetchCatPro', this.$route.params.url)
       } else {
           return this.$store.dispatch('fetchAllProduct')
       }
     }
  },

  watch: {
    $route (to, from) {
       this.getAllCatProduct()
    }
  }
};
</script>

<style scoped>
#cart {
  float: right;
  /* margin: 0px 0px 0px 5px; */
}
#detail {
  float: left;
  margin: 0px 5px 0px 15px;
}
</style>