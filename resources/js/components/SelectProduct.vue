<template>
    <select id="product" name="product_id" class="form-control" v-loading="options">
        <option selected>Escolha...</option>
        <option v-for="item in options" value="item.id">{{ item.name }}</option>
    </select>
</template>

<script>
export default {
    data() {
        return {
            options: []
        }
    },
    mounted() {
        this.loadProducts();
    },
    methods: {
        loadProducts() {
            this.loading = true;
            axios.get('/api/products')
                .then((response) => {
                    this.loading = false
                    this.options = response.data.data
                })
                .catch(function (error) {
                    this.loading = false
                    console.warn(error);
                })

        }
    }
}
</script>
