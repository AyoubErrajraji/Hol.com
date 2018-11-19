<template>
    <div>
        <b-nav-item-dropdown v-if="user" right>
            <!-- Using button-content slot -->
            <template slot="button-content">
                <em>{{ user.name }}</em>
            </template>
            <b-dropdown-item href="#">Profiel</b-dropdown-item>

            <b-dropdown-item href="logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Uitloggen</b-dropdown-item>

        </b-nav-item-dropdown>
        <b-nav-item v-else href="sign-in">Login</b-nav-item>
    </div>
</template>

<script>
    export default {
        name: 'user-component',
        computed: {
            user() { return this.$store.getters.user },
        },
    }
</script>