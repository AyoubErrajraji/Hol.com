<template>
    <div>
        <div v-if="auctionsLoaded">
            <product-component v-for="(a, i) in auctions"
                               :key="a.id"
                               :ad="a"
                               :index="i"
                               style="list-style-type: none;">
            </product-component>
        </div>
        <div v-else>
            <product-loading-component v-for="i in 6"
                                       :key="'alc' + i"
                                       :index="i">
            </product-loading-component>
        </div>
    </div>
</template>

<script>
    import ProductComponent from '../components/ProductComponent'
    import ProductLoadingComponent from '../components/ProductLoadingComponent'
    export default {
        name: "home",
        components: {
            ProductComponent,
            ProductLoadingComponent
        },
        computed: {
            products() {
                return this.$store.getters.products;
            },
            productsLoaded() {
                return this.$store.getters.productsLoaded;
            },
            user() {
                return this.$store.getters.user
            },
        },
    }
</script>

<style>

</style>