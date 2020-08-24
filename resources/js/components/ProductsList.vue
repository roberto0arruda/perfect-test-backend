<template>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Produtos
                <a class='btn btn-secondary float-right btn-sm rounded-pill' href='/products'><i class='fa fa-plus'></i>
                    Novo produto</a></h5>
            <table class='table'>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
                <tr v-for="product in products">
                    <td>{{ product.name }}</td>
                    <td>R$ {{ product.price }}</td>
                    <td>
                        <a :href="`/products?${product.id}`" class='btn btn-primary'>Editar</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            products: []
        }
    },

    mounted() {
        this.loadProducts();
    },

    methods: {
        loadProducts() {
            axios.get('/api/products')
                .then((response) => {
                    this.products = response.data.data
                })
                .catch(function (error) {
                    console.warn(error);
                })

        }
    }
};
</script>
