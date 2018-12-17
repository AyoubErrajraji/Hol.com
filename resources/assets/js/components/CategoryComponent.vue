<template>
    <div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">CATEGORIEËN</li>

            <li v-for="(category, index) in categories" v-bind:key="index">
                <router-link :to="{name: 'Category', params: {id: category.id} }">
                    <i class="fa fa-circle text-red"></i>
                    <span>{{ category.name }}</span>
                </router-link>
            </li>

        </ul>
    </div>
</template>

<script>
    export default {
        name: 'category-component',
        computed: {
            categories() { return this.$store.getters.categories; },
        }
    }
</script>

<style>

</style>