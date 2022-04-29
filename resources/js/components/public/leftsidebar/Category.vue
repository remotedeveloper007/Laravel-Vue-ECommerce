<template>
    <div>
        <h2 id="head">Category</h2>
    <div class="panel-group category-products" id="accordian">
        <!--category-productsr--><template v-for="category in mainCategory" >
        <div class="panel panel-default" :key="category.id">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordian" :href="'#'+category.url">
                        <span  class="badge pull-right"><i class="fa fa-plus"></i></span>
                        {{ category.name }}
                    </a>
                </h4>
            </div>
            <div :id="''+category.url" :key="category.id" class="panel-collapse collapse">
                <div class="panel-body">
                    <ul>
                        <li v-for="subcategory in getSubCategory" :key="subcategory.id">
                            <span v-if="subcategory.parent_id == category.id">
                                <router-link :to="`/subcategory-products/${subcategory.url}`">{{subcategory.name}}</router-link>
                            </span>
                        </li>                       
                    </ul>
                </div>
            </div>
        </div></template>
    </div>
   </div>
    <!--/category-products-->
</template>

<script>
import _ from 'lodash';
export default {
    data() {
        return {
            id: []
        };
    },
    mounted() {
        //  this.subcategory()
        /**
         *
         */
        this.$store.dispatch('fetchAllCategories');
        // this.$store.dispatch("allCategory");
        /**
         * allSubcategory function taken from store/admin/actions: allSubcategory()
         * to Dispaly data
         */
        this.$store.dispatch("fetchAllSubcategories");
    },
    computed: {
        mainCategory() {
            /**
             * Fetch category for category field with parent_id = NULL
             */
            return this.$store.getters.getCategories;
        },
        /**
         * getallCategory() function fetch all Category from
         * store/admin/actions: getCategory() function for dispaly ManageCategory.vue
         */
        getSubCategory() {
            return this.$store.getters.getSubcategories;
        }
    },
    methods: {
        
    },

    // watch: {
    //     $route(to, from) {
    //         this.subcategory()
    //     }
    // }
};
</script>

<style scoped>
  #head{
    position:relative;
    z-index: 2;
  }
</style>
