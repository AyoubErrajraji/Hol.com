<template>
    <!--<div class="card-token" v-if="isWatchlistLoaded">-->
        <!--<a v-on:click="userClicked()">-->
            <!--<i class="fas fa-heart" aria-haspopup="true" aria-expanded="false"></i>-->
        <!--</a>-->
    <!--</div>-->

    <li id="dropdown-watchlist" class="dropdown user user-menu">
        <!-- Menu Toggle Button -->
        <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-heart"></i> ({{ wishlist.length }})
        </a>
        <ul class="dropdown-menu">

            <li class="user-body" v-for="(wishlistitem,index) in wishlist" v-bind:key="index">
                <div class="pull-left">
                    <img :src="wishlistitem.product.image" class="cart-item-image">
                    {{ wishlistitem.product.title }}
                    <p><b> €{{ wishlistitem.product.price + ",-" }} </b></p>
                </div>
                <div class="pull-right">
                    <button class="btn btn-sm btn-danger"v-on:click="removeFromWishList(index)">Verwijder product</button>
                </div>

            </li>
            <li class="user-footer">
                Totaal: €<b>{{total}},-</b>
                <router-link to="/cart">Bekijk hele wishlist</router-link>
            </li>
        </ul>
    </li>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "wishlist-component",
        props: ['user_id', 'ad_id'],
        data() {
            return {
                watchlistItem: {
                    user_id: this.user_id,
                    ad_id: this.ad_id
                }
            }
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


            axios.get(`/api/wishlistitem`).then(result => {
                var i;
                for (i=0; i<result.data.length; i++){
                    this.addToWishListFromDb()(result.data[i]);
                }
            }).catch((e) => {
                this.errorMessages.push(e);
            })

        },
        computed: {
            // isWatchlistLoaded() {
            //     return this.$store.getters.watchlistLoaded;
            // },
            isAdInWatchlist() {
                return this.$store.getters.isAdInWatchlist(this.ad_id);
            }
        },
        methods: {
            userClicked() {
                if (this.isAdInWatchlist) {
                    this.removeFromWishList();
                } else {
                    this.addToWishList();
                }
            },
            // addToWishList() {
            //     this.start();
            //     axios.post('/api/watchlistitem', this.watchlistItem)
            //         .then(res => {
            //             this.$store.dispatch('addWatchlistItem', res.data)
            //                 .then(() => console.log('Watchlist item added to store state'));
            //             this.finish();
            //         })
            //         .catch(err => {
            //             console.log(err);
            //             this.fail();
            //         });
            // },
            // removeFromWishList() {
            //     this.start();
            //     const item = this.$store.getters.getWatchlistItemByAdId(this.ad_id);
            //     axios.delete(`/api/wishlistitem/${item.id}`)
            //         .then(() => {
            //             this.$store.dispatch('deleteWisListItem', item.id)
            //                 .then(() => console.log('Wishlist item deleted from store state'));
            //             this.finish()
            //         })
            //         .catch(err => {
            //             console.log(err);
            //             this.fail()
            //         });
            // },
            // start () {
            //     this.$Progress.start()
            // },
            // increase (num) {
            //     this.$Progress.increase(num)
            // },
            // finish () {
            //     this.$Progress.finish()
            // },
            // fail () {
            //     this.$Progress.fail()
            // },
        }
    }
</script>

<style scoped>

</style>
