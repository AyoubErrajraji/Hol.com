<template>
    <div id="app">
        <h1 class="title">Winkelwagen: </h1>

        <div v-for="(product,index) in inCart" v-bind:key="index">
            <h4><b>{{product.title}}</b></h4>

             <h4><b>Prijs: €{{product.price + ",-"}}</b></h4>

            <ul class="items">
                <li class="item">
                    <div class="item-preview">
                        <img :src="product.image" class="cart-item-image item-thumbnail">
                        <div>
                            <h2 class="item-title"></h2>
                            <p class="item-description"></p>
                            <b>Aantal:</b>
                            <input type = "text" placeholder="1" class="item-quantity">
                            <span class="item-price"></span>
                            <button class="btn btn-sm btn-danger"v-on:click="inCart.splice(index, 1)">Verwijder product</button>

                        </div>
                    </div>
                    <div>

                    </div>
                </li>
            </ul>
        </div>

        <h3 class="cart-line">
            Subtotaal: €{{Subtotal}},- <span class="cart-price cart-total"></span>
            BTW(21%): €{{BTW}},- <span class="cart-price cart-total"></span>
            Totaal: €{{totalBTW}},-<span class="cart-price cart-total"></span>
        </h3>

        <router-link to="/"><button class="button1">< Verder met winkelen</button></router-link>
        <router-link to="/checkout"><button  class="button2"> > Verder met bestellen</button></router-link>

    </div>

</template>

<script>
    import CartComponent from '../components/CartComponent'
    import axios from 'axios'

    export default {
        name: "Cart",
        components: {
            CartComponent
        },

        computed: {
            totalBTW() {
                return this.$store.getters.inCart.reduce(function (sum, item) {
                    return Math.round(sum + item.price + item.price * (0.21))

                },0)
            },

            BTW(){
                return this.$store.getters.inCart.reduce(function (sum, item) {
                    return Math.round(sum + item.price * (0.21))

                },0)
            },

            Subtotal() {
                return this.$store.getters.inCart.reduce(function (sum, item) {
                    return Math.round(sum + item.price)

                }, 0)
            },

            inCart() {
                return this.$store.getters.inCart;
            },
            user() {
                return this.$store.getters.user
            },

            mounted() {
                this.$store.dispatch('addUser', this._user)
                    .then(() => console.log('User added to store state'));
            },

            created() {
                axios.get(`/api/products/${this.orderBy}`).then(result => {
                    this.addProducts(result.data);
                }).catch((e) => {
                    this.errorMessages.push(e);
                })
            },

            methods: {
                addProducts(data) {
                    this.$store.dispatch('addProducts', data)
                        .then(() => console.log('Products added to store state'));
                },
                removeFromCart(invId) {
                    this.$store.dispatch('removeFromCart', invId);

                },
            }
        }
    }

</script>

<style scoped>
    body {
        margin: 0;
        background: #fdca40;
        padding: 30px;
    }

    .title {
        font-family: "Avant Garde", Avantgarde, "Century Gothic", CenturyGothic, "AppleGothic", sans-serif;
        font-size: 70px;
        padding: 0px 0px;
        text-align: left;
        text-transform: uppercase;
        text-rendering: optimizeLegibility;
        color: #131313;
        letter-spacing: -1px;
        text-shadow:
                1px -1px 0 #767676,
                -1px 2px 1px #737272,
                -2px 4px 1px #767474,
                -3px 6px 1px #787777,
                -4px 8px 1px #7b7a7a,
                -5px 10px 1px #7f7d7d,
                -6px 12px 1px #828181,
                -7px 14px 1px #868585,
                -8px 16px 1px #8b8a89,
                -9px 18px 1px #8f8e8d,
                -10px 20px 1px #949392,
                -11px 22px 1px #999897,
                -12px 24px 1px #9e9c9c,
                -13px 26px 1px #a3a1a1,
                -14px 28px 1px #a8a6a6,
                -15px 30px 1px #adabab,
                -16px 32px 1px #b2b1b0,
                -17px 34px 1px #b7b6b5,
                -18px 36px 1px #bcbbba,
                -19px 38px 1px #c1bfbf,
                -20px 40px 1px #c6c4c4,
                -21px 42px 1px #cbc9c8,
                -22px 44px 1px #cfcdcd,
                -23px 46px 1px #d4d2d1,
                -24px 48px 1px #d8d6d5,
                -25px 50px 1px #dbdad9,
                -26px 52px 1px #dfdddc,
                -27px 54px 1px #e2e0df,
                -28px 56px 1px #e4e3e2;
    }
    .items {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .cart {
        background: #fff;
        font-family: 'Helvetica Neue', Arial, sans-serif;
        font-size: 16px;
        color: #333a45;
        border-radius: 3px;
        padding: 30px;
    }
    .cart-line {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 20px 0 0 0;
        font-size: 150%;
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
    }
    .item-thumbnail {
        margin-right: 20px;
        border-radius: 3px;
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
        font-size: inherit;
        color: rgba(51, 58, 69, 0.8);
        border: 2px solid rgba(51, 58, 69, 0.1);
        border-radius: 3px;
        text-align: center;
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