<template>
    <div class="tab-pane active" id="control-sidebar-settings-tab" v-if="settingsLoaded">
        <form method="post">
            <h3 class="control-sidebar-heading">Algemene Instellingen</h3>

            <div class="form-group">
                <label class="control-sidebar-subheading">
                    Naam
                </label>
                <p>
                    {{ settings.name }}
                </p>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
                <label class="control-sidebar-subheading">
                    Email
                </label>
                <p>
                    {{ settings.email }}
                </p>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
                <label class="control-sidebar-subheading">
                    Gebruiker sinds
                </label>
                <p>
                    {{ settings.created_at }}
                </p>
            </div>
            <!-- /.form-group -->

            <h3 class="control-sidebar-heading">Email Instellingen</h3>

            <div class="form-group">
                <label class="control-sidebar-subheading">
                    Bij overboden
                    <input type="checkbox" class="pull-right" :checked="settings.settings.email_on_outbit" @change="toggleSetting(settings.settings.id, 'email_on_outbit')">
                </label>

                <p>
                    Laat ons je e-mailen zodra je overboden bent
                </p>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
                <label class="control-sidebar-subheading">
                    Bij observatielijst item
                    <input type="checkbox" class="pull-right" :checked="settings.settings.email_on_closed_watchlistitem" @change="toggleSetting(settings.settings.id, 'email_on_closed_watchlistitem')">
                </label>

                <p>
                    Laat ons je e-mailen zodra een advertentie uit je observatielijst gesloten is
                </p>
            </div>
            <!-- /.form-group -->

            <div class="form-group">
                <label class="control-sidebar-subheading">
                    Bij bieding
                    <input type="checkbox" class="pull-right" :checked="settings.settings.email_on_bid_for_your_ad" @change="toggleSetting(settings.settings.id, 'email_on_bid_for_your_ad')">
                </label>

                <p>
                    Laat ons je e-mailen zodra iemand op uw advertentie geboden heeft
                </p>
            </div>
            <!-- /.form-group -->
        </form>
    </div>
</template>

<script>
    export default {
        name: "settings-component",
        computed: {
            settings() {
                return this.$store.getters.settings;
            },
            settingsLoaded() {
                return this.$store.getters.settingsLoaded;
            },
        },
        created() {
            if(!this.$store.getters.settings && this.$store.getters.user){
                axios.get(`/api/settings/${this.$store.getters.user.id}`)
                    .then(response => {
                        this.$store.dispatch('addSettings', response.data)
                            .then(() => { console.log('Settings added to store state') });
                    })
                    .catch(err => {
                        this.$store.dispatch('addError', err)
                            .then(() => { console.log('Error added to store state') })
                    });
            }
        },
        methods: {
            toggleSetting(id, type){
                this.start();
                let array = {
                    id: id,
                    type: type
                };
                axios.put('/api/settings', array)
                    .then(response => {
                        this.finish();
                    })
                    .catch(err => {
                        console.log(err);
                        this.fail();
                    });
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
        }
    }
</script>

<style scoped>

</style>