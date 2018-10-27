<template>
    <form v-on:submit.prevent="onSearch()" class="sidebar-form">
        <div class="input-group">
            <input v-on:keyup="onSearch()" v-model="search" type="text" name="search" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
            </span>
        </div>
    </form>
</template>

<script>
    export default {
        name: "search-component",
        data() {
          return {
              search: "",
          }
        },
        methods: {
            onSearch() {
                this.$store.dispatch('setSearch', this.search);
             }
        }
    }
</script>

<style scoped>

</style>