<template>
    <div id="app">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">WishList</h3>
                <div class="box-tools pull-right">
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>

                            <div v-for="(product,index) in inWishList" v-bind:key="index">
                                <h4><b>{{product.title}}</b></h4>

                                <h4><b>Prijs: €{{product.price + ",-"}}</b></h4>

                                <ul class="items">
                                    <li class="item">
                                        <div class="item-preview">
                                            <img :src="product.image" class="cart-item-image item-thumbnail">
                                            <div>
                                                <h2 class="item-title"></h2>
                                                <p class="item-description"></p>
                                                <button class="btn-apricot" @click="addToCart(product)"> Winkelwagen </button>
                                                <span class="item-price"></span>
                                                <button class="btn btn-sm btn-danger"v-on:click="removeFromWishList(index)">Verwijder product</button>

                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>|


                            <div class="box-footer clearfix">
                                <router-link to="/"><a href="javascript:void(0)" class="btn btn-sm btn-info btn-primary pull-left">< Verder met winkelen</a></router-link>

                            </div>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    import CartComponent from '../components/CartComponent'
    import axios from 'axios'

    export default {
        name: "WishList",
        data(){
            return{
                products:[]
            }
        },
        components: {
            CartComponent
        },
        computed: {
            inWishList() {
                return this.$store.getters.inWishList;
            },
            user() {
                return this.$store.getters.user
            },
            userLoaded() {
                return this.$store.getters.userLoaded
            },
        },
        mounted() {

        },

        created(){
            axios.get(`/api/wishlistitem/1`).then(result => {
                var i;
                for (i=0; i<result.data.wishlistitems.length; i++){
                    this.addToWishListFromDb(result.data.wishlistitems[i].product);
                }
            }).catch((e) => {
                this.errorMessages.push(e);
            })
        },

        methods: {
            addProducts(data) {
                this.$store.dispatch('addProducts', data)
                    .then(() => console.log('Products added to store state'));
            },
            removeFromWishList(invId) {
                this.$store.dispatch('removeFromWishList', invId)
                    .then(() => console.log('aaaaaaa'));
            },
            addToWishList(invId) {
                this.$store.dispatch('addToWishList', invId)
                    .then(() => console.log('bladibla'));
            },
            addToWishListFromDb(invId) {
                this.$store.dispatch('addToWishListFromDb', invId)
                    .then(() => console.log('hopsakee'));

            },
            addToCart(invId) {
                this.$store.dispatch('addToCart', invId)
            },

        },
    }

</script>

<style scoped>
    body {
        margin: 0;
        background: #fdca40;
        padding: 30px;
    }

    .btn-apricot {
        background-color: #F7882F;
        color: white;
    }

    .items {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .cart-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 7px 400px 0px 400px;
        font-size: 130%;
        font-weight: bold;
        color: rgba(51, 58, 69, 0.8);
    }
    .cart-price {
        color: #333a45;
    }
    .cart-total {
        font-size: 200%;
    }

    .item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 2px solid rgba(51, 58, 69, 0.1);
    }
    .item-preview {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .item-thumbnail {
        margin-right: 20px;
        border-radius: 3px;
        justify-content: space-between;
    }
    .item-title {
        margin: 0 0 10px 0;
        font-size: inherit;
        font-weight: bold;
    }
    .item-description {
        margin: 0;
        color: rgba(51, 58, 69, 0.6);
    }
    .item-quantity {
        max-width: 30px;
        padding: 8px 12px;
        color: rgba(51, 58, 69, 0.8);
        border: 2px solid rgba(51, 58, 69, 0.1);
        border-radius: 3px;
    }
    .item-price {
        margin-left: 20px;
    }
    .text1{

        margin: 0px 0px 0px 25px;
        font-weight: bold;


    }

    .MoveText{

        margin: 20px 800px 10px 10px;


    }

    .button1{

        background-color: #4CAF50; /* Green */
        border: none;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 15px 100px  0px 1250px;
    }
    .button1:hover {
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
    .button2:hover {
        box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    }
    .button2{
        background-color: #008CBA; /* Green */
        border: none;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 10px 100px 0px 1250px;
    }

</style>