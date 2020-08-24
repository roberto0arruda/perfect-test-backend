<template>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Resultado de vendas</h5>
            <table class='table'>
                <tr>
                    <th scope="col">Status</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Valor Total</th>
                </tr>
                <tr v-for="(result, i) in results">
                    <td>{{ i }}</td>
                    <td>{{ result.quantity }}</td>
                    <td>R$ {{ result.total }}</td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            results: []
        }
    },
    mounted() {
        this.loadResults();
    },

    methods: {
        loadResults() {
            axios.get('/api/dashboard')
                .then((response) => {
                    this.results = response.data
                })
                .catch(function (error) {
                    console.warn(error);
                })
        }
    },
}
</script>
