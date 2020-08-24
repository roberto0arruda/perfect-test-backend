<template>
    <div class="SalesList">
        <h1>Adicionar / Editar Venda</h1>
        <div class='card'>
            <div class='card-body'>
                <form @submit.prevent="submit">
                    <h5>Informações do cliente</h5>
                    <div class="form-group">
                        <label for="name">Nome do cliente</label>
                        <input :class="{'is-invalid': errors['customer.name']}" class="form-control" id="name"
                               type="text" v-model="sale.customer.name">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input :class="{'is-invalid': errors['customer.email']}" class="form-control" id="email"
                               type="email" v-model="sale.customer.email">
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <input :class="{'is-invalid': errors['customer.cpf']}" class="form-control"
                               :readonly="sale.id"
                               id="cpf" maxlength="11"
                               placeholder="99999999999"
                               type="text" v-model="sale.customer.cpf">
                    </div>
                    <h5 class='mt-5'>Informações da venda</h5>
                    <div class="form-group">
                        <label for="product">Produto</label>
                        <select :class="{'is-invalid': errors['product.id']}" class="form-control" id="product"
                                v-model="sale.product.id">
                            <option :value="null" selected>Escolha...</option>
                            <option :value="item.id" v-for="item in options">{{ item.name }}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Data</label>
                        <input :class="{'is-invalid': errors.date}" class="form-control single_date_picker" id="date"
                               ref="date" type="text">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantidade</label>
                        <input :class="{'is-invalid': errors.quantity}" class="form-control" id="quantity" maxlength="2"
                               placeholder="1 a 10" type="text"
                               v-model="sale.quantity">
                    </div>
                    <div class="form-group">
                        <label for="discount">Desconto</label>
                        <input :class="{'is-invalid': errors.discount}" class="form-control" id="discount"
                               maxlength="3" placeholder="100,00 ou menor" type="text"
                               v-model="sale.discount">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select :class="{'is-invalid': errors.status}" :value="sale.status" class="form-control"
                                id="status" v-model="sale.status">
                            <option :value="null" selected>Escolha...</option>
                            <option value="approved">Aprovado</option>
                            <option value="canceled">Cancelado</option>
                            <option value="returned">Devolvido</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" type="submit">Salvar</button>
                    <template v-if="Object.keys(errors).length !== 0">
                        <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
                        <ul>
                            <li v-for="item in errors">{{ item }}</li>
                        </ul>
                    </template>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import SelectProduct from "./SelectProduct";

export default {
    components: {
        SelectProduct
    },

    data() {
        return {
            options: [],
            errors: [],
            sale: {
                customer: {
                    name: null,
                    email: null,
                    cpf: null
                },
                product: {
                    id: null
                },
                quantity: null,
                status: null,
                date: null,
                discount: null
            }
        }
    },

    mounted() {
        let id = window.location.search.replace("?", '');
        if (id) this.loadSale(id);

        this.loadProducts();
    },

    beforeUpdate() {
        this.sale.date = this.$refs.date.value.split('/').reverse().join('-')
    },

    methods: {
        loadProducts() {
            axios.get('/api/products')
                .then((response) => {
                    this.options = response.data.data
                })
                .catch(function (error) {
                    console.warn(error);
                })
        },
        submit() {
            let options = this.sale.id
                ? {method: 'put', url: `/api/sales/${this.sale.id}`}
                : {method: 'post', url: '/api/sales'}

            this.errors = []

            axios[options.method](options.url, {
                ...this.sale
            }).then(() => {
                window.location = '/'
            }).catch((error) => {
                this.errors = Object.assign({}, this.errors, {...error.response.data.errors})
            })
        },
        loadSale: function (id) {
            axios.get(`/api/sales/${id}`)
                .then((response) => {
                    this.sale = response.data
                })
                .catch(function (error) {
                    console.warn(error);
                })
        }
    },
}
</script>
