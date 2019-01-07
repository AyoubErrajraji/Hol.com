<template>
    <div class="col-md-4">
        <div class="box box-solid " style="height: 450px;">
            <div class="box-header with-border">
                <h3 class="box-title">{{ product.title }}</h3>
                <h4 v-for="category in product.categories"> {{ category.name }} </h4>
            </div>
            <div class="box-body text-center">
                <img :src="product.image " style="height: 250px;">
                <p>€{{product.price}},-</p>
                <hr>

                <button class="btn btn-apricot" @click="addToCart(product)">Winkelwagen</button>
                <router-link class="btn btn-blueberry" :to="{name: 'Product', params: {id: product.id} }">Lees meer</router-link>
                <button class="btn btn-apricot" @click="addToWishList">AddToWishlist</button>
                <router-link to="/watchlist"><a href="javascript:void(0)" class="btn btn-apricot"> WishList </a></router-link>


            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "ProductComponent",
        props: {
            product: {
                required: true,
                type: Object
            }
        },
        filters: {
            toString: function (value) {
                if (!value) return '';
                return value.toString()
            }
        },
        // beforeRouteUpdate(to) {
        //
        //     console.log(to.params.id);
        //     this.id = to.params.id;
        //     console.log(this.$route.params.id);
        //     axios.get(`/api/product/${to.params.id}`, {
        //     }).then(result => {
        //         this.product = result.data;
        //     }).catch((e) => {
        //         this.errorMessages.push(e);
        //     });
        // },
        methods: {
            addToCart(invId) {
                this.$store.dispatch('addToCart', invId)
            },
            addToWishList() {
                this.$store.dispatch('addToWishList', this.product.id)
            },
        },
        computed: {
            inCart() {
                return this.$store.getters.inCart;
            },

            inWishList() {
                return this.$store.getters.inWishList;
            },
        },
    }
</script>

<style>
    .btn-apricot {
        background-color: #F7882F;
        color: white;
    }

    .btn-aprico {
        background-color: #F7882F;
        color: white;
    }

    .btn-blueberry {
        background-color: #6B7A8F;
        color: white;
    }
</style>