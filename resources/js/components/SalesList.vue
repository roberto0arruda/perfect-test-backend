<template>
    <div class='card mt-3'>
        <div class='card-body'>
            <h5 class="card-title mb-5">Tabela de vendas
                <a href='/sales' class='btn btn-secondary float-right btn-sm rounded-pill'><i class='fa fa-plus'></i>
                    Nova venda</a></h5>
            <form>
                <div class="form-row align-items-center">
                    <div class="col-sm-5 my-1">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Clientes</div>
                            </div>
                            <select class="form-control" id="inlineFormInputName">
                                <option>Clientes</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 my-1">
                        <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Período</div>
                            </div>
                            <input type="text" class="form-control date_range" id="inlineFormInputGroupUsername"
                                   placeholder="Username">
                        </div>
                    </div>
                    <div class="col-sm-1 my-1">
                        <button type="submit" class="btn btn-primary" style='padding: 14.5px 16px;'>
                            <i class='fa fa-search'></i></button>
                    </div>
                </div>
            </form>
            <table class='table'>
                <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Data</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Ações</th>
                </tr>
                <tr v-for="sale in sales">
                    <td>{{ sale.product.name }}</td>
                    <td>{{ sale.date }}</td>
                    <td>R$ {{ valor(sale) }}</td>
                    <td><a :href="`/sales?${sale.id}`" class='btn btn-primary'>Editar</a></td>

                </tr>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            sales: [],
            customers: []
        }
    },

    mounted() {
        this.loadSales();
    },

    methods: {
        loadSales() {
            axios.get('/api/sales')
                .then((response) => {
                    this.sales = response.data.data
                })
                .catch(function (error) {
                    console.warn(error);
                })

        },

        valor(sale) {
            return ((sale.product.price * sale.quantity) - sale.discount).toFixed(2)
        }
    }

}
</script>

