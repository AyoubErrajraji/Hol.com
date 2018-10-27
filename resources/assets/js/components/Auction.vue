<template>
    <div v-if="auction">
        <div class="auctionCard-list-item">
            <div class="auctionCard">
                <div class="auctionCard-image">
                    <img src="../../img/Logo.png">
                </div>
                <div class="auctionCard-text">
                    <h2>{{ auction.title }}</h2>
                    <p>{{ auction.body }}</p>
                    <h4>{{ auction.user.name }}</h4>
                    <router-link :to="{name: 'veiling'}">GO BACK</router-link>
                </div>
                <div class="auctionCard-business">
                    <div>
                        <h4>huidig bod</h4>
                        <h3>{{ latestBid.price }}</h3>
                        <div v-if="user">
                            <div>
                                <input type="text" value="€" disabled="true" class="euro">
                                <input type="text" class="input-bid" v-model.number="currentBid">
                                <button class="btn-bid" @click="sentbid">Bieden</button>
                            </div>
                            <div class="auctionCard-quickbid">
                                <button class="btn-1" @click="quickBid(latestBid.price + 1)">€{{ latestBid.price + 1 }}</button>
                                <button class="btn-3" @click="quickBid(latestBid.price + 3)">€{{ latestBid.price + 3 }}</button>
                                <button class="btn-5" @click="quickBid(latestBid.price + 5)">€{{ latestBid.price + 5 }}</button>
                            </div>
                        </div>
                        <span style="color: red;">{{error_message}}</span>
                        <countdown :time="timeLeft">
                            <template slot-scope="props">Time Remaining：{{ props.days }} days, {{ props.hours }} hours, {{ props.minutes }} minutes, {{ props.seconds }} seconds.</template>
                        </countdown>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import Countdown from '@xkeshi/vue-countdown'
    export default {
        name: "auction",
        components: {Countdown},
        props: ['auction'],
        data() {
            return {
                currentBid: null,
                error_message: null,
            };
        },
        computed: {
            latestBid() {
                return this.$store.getters.getLatestBidById(this.auction.id);
            },
            user() {
                return this.$store.getters.user;
            },
            timeLeft() {
                const end = new Date(this.auction.closing_at).getTime();
                const now = new Date().getTime();

                return end-now;
            }
        },
        methods: {
            sentbid() {
                this.start();
                // Emits bidsent event to toggle the addBid method on parent
                // Client side validation
                if(this.user) {
                    if (typeof this.currentBid === "number") {
                        if (this.currentBid > this.latestBid.price) {
                            let bid = {
                                price: null,
                                by_id: this.user.id,
                                on_id: this.auction.id,
                                active: 1
                            };
                            bid.price = this.currentBid;

                            axios.post('../../api/bids', bid)
                                .then(response => {
                                    console.log(`Bid successfully sent: ${response}`);
                                    this.error_message = "Bid successfully placed!";
                                    this.finish();
                                })
                                .catch(err => {
                                    this.fail();
                                    this.error_message = err.response.data.error;
                                });

                            this.currentBid = null;
                        } else {
                            this.error_message = "A higher bid has already been made";
                            this.fail();
                        }
                    } else {
                        // Bid is not a valid number
                        this.error_message = "Only numbers are allowed";
                        this.fail();
                    }
                } else {
                    // User is not signed in
                    this.error_message = "You must be logged in to place a bid"
                    this.fail();
                }
            },
            quickBid(amt) {
                console.log(`Trying to set the bid price to: ${amt}`);
                this.currentBid = amt;
                this.sentbid();
            },
            start () {
                this.$Progress.start()
            },
            increase (num) {
                this.$Progress.increase(num)
            },
            finish () {
                this.$Progress.finish()
            },
            fail () {
                this.$Progress.fail()
            },
        },
    }
</script>

<style>
    .auctionCard-list-item {
        width: 100%;
        max-width: 1104px;
        display: list-item;
    }

    .auctionCard {
        background-color: #fff;
        box-shadow: 0 0 2.5rem 0.3125rem rgba(34, 35, 36, 0.05);
        min-height: 224px;
        font-size: 12px;
        color: #999;
        border-radius: 2px;
        overflow: hidden;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
    }

    .auctionCard-image {
        display : flex;
        align-items: center;
    }

    .auctionCard-image img {
        width: 100%;
        height: auto;
    }

    .auctionCard-text {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        align-content: space-around;
    }

    .auctionCard-business {
        display: flex;
        flex-direction: column;
        justify-content: space-around;
        align-items: flex-end;
        align-content: space-around;
        text-align: right;
    }

    .auctionCard-business h4 {
        margin-bottom: 0px;
    }
    .auctionCard-business h3 {
        margin-top: 0px;
    }
    .auctionCard-business .euro {
        width: 10%;
        border: 1px solid #13b1cd;
        border-right: none;
        font-size: 25px;
        padding: 0;
        font-family: 'Montserrat';
    }
    .auctionCard-business .input-bid {
        width: 40%;
        border: 1px solid #13b1cd;
        border-left: none;
        font-size: 25px;
        padding: 0;
        margin-left: -2.5px;
        font-family: 'Montserrat';
    }
    .auctionCard-business .btn-bid {
        background-color: #13b1cd;
        border: 1px solid #13b1cd;
        color: white;
        font-size: 25px;
        padding: 0;
        width: 50%;
        font-family: 'Montserrat';
        border-right: none;
    }

    .auctionCard-business .auctionCard-quickbid {
        margin-top: 10px;
        display: flex;
        justify-content: space-between;
    }

    .auctionCard-business .btn-1,.btn-3, .btn-5 {
        background-color: #13b1cd;
        border: 1px solid #13b1cd;
        color: white;
        font-size: 25px;
        padding: 0;
        width: 30%;
        font-family: 'Montserrat';
        border-right: none;
    }

    @media (min-width: 0px){
        .auctionCard {
            padding: 18px;
            margin-bottom: 20px;
        }
        .auctionCard-image {
            width: 100%;
        }
        .auctionCard-text {
            width: 100%;
            padding: 10px 10px 0px 10px;
        }
        .auctionCard-business {
            width: 100%;
            padding: 0px 10px 10px 10px;
        }
    }

    @media (min-width: 600px){
        .auctionCard {
            padding: 18px;
            margin-bottom: 20px;
        }
        .auctionCard-image {
            width: 40%;
        }
        .auctionCard-text {
            width: 60%;
            padding: 10px 10px 10px 10px;
        }
        .auctionCard-business {
            width: 100%;
            padding: 10px 10px 10px 5px;
        }
    }

    @media (min-width: 768px) {
        .auctionCard-image {
            width: 30%;
        }
        .auctionCard-text {
            width: 42%;
            padding: 10px 10px 10px 10px;
        }
        .auctionCard-business {
            width: 28%;
            padding: 10px 10px 10px 5px;
        }
    }

    @media (min-width: 992px) {
        .auctionCard-image {
            width: 30%;
        }
        .auctionCard-text {
            width: 42%;
            padding: 10px 10px 10px 20px;
        }
        .auctionCard-business {
            width: 28%;
            padding: 10px 10px 10px 5px;
        }
    }

    @media (min-width: 1200px){
        .auctionCard-image {
            width: 30%;
        }
        .auctionCard-text {
            width: 42%;
            padding: 10px 10px 10px 20px;
        }
        .auctionCard-business {
            width: 28%;
            padding: 10px 10px 10px 50px;
        }
    }
</style>