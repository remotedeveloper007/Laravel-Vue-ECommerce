<template>
  <div>
    <!--===============================================================================================-->
    <span v-if="userLoggedIn"><Header v-bind:username="myProfile.name" /></span>
    <span v-else><Header1 /></span>
    <!--===============================================================================================-->
    <!-- Banner Top Navigation -->
    <Slider />
    <!--===============================================================================================-->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-sm-3">
            <div style="stick-top: 0px" class="left-sidebar">
              <!--category-productsr-->
              <Category />
              <!--/category-products-->
              <!--===============================================================================================-->
              <!--brands_products-->
              <Brand />
              <!--/brands_products-->
              <!--===============================================================================================-->
              <!--price-range & shipping -->
              <PriceRange />
              <!-- /price-range & shipping -->
              <!--===============================================================================================-->
              <div class="shipping text-center">
                <!--shipping-->
                <img src="/assets/public/images/home/shipping.jpg" alt="" />
              </div>
              <!--/shipping-->
            </div>
          </div>
          <!--===============================================================================================-->
          <div class="col-sm-9 padding-right">
            <!--features_items-->
            <FeaturesItems />
            <!-- //features_items-->
            <!--===============================================================================================-->
            <!--category-tab-->
            <CategoryTab />
            <!-- //category-tab-->
            <!--===============================================================================================-->
            <!-- recommended_items-->
            <RecommendedItems />
            <!--/recommended_items-->
            <!--===============================================================================================-->
          </div>
        </div>
      </div>
    </section>
    <!--=========================================== FOOTER ====================================================-->

    <!--===============================================================================================-->
  </div>
</template>

<script>
import { userComputed } from "../../vuex/helper.js";
import Header from "./header/header.vue";
import Header1 from "./common/header.vue";
import Slider from "./header/Slider.vue";
import FeaturesItems from "./bodycontent/FeaturesItems.vue";
import CategoryTab from "./bodycontent/CategoryTab.vue";
import RecommendedItems from "./bodycontent/RecommendedItems.vue";
import Category from "./leftsidebar/Category.vue";
import Brand from "./leftsidebar/Brand.vue";
import PriceRange from "./leftsidebar/PriceRange.vue";
export default {
  components: {
    Header,
    Header1,
    Slider,
    FeaturesItems,
    CategoryTab,
    RecommendedItems,
    /**
     * LeftSidebar
     */
    Category,
    Brand,
    PriceRange,
  },
  data() {
    return {
      token: axios.defaults.headers.common["Authorization"],
      username: "",
      name: "",
    };
  },

  computed: {
    ...userComputed,
    myProfile() {
      // if (this.token) {
      return this.$store.getters.getProfile;
      // }
    },
  },
  mounted() {
    // if (this.token) {
    this.$store.dispatch("myProfile");
    // }
  },
  methods: {},
};
</script>