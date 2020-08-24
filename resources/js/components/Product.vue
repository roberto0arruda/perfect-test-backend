<template>
    <div class="product">
        <h1>Adicionar / Editar Produto</h1>
        <div class='card'>
            <div class='card-body'>
                <form @submit.prevent="submit">
                    <template v-if="Object.keys(errors).length !== 0">
                        <b>Por favor, corrija o(s) seguinte(s) erro(s):</b>
                        <ul>
                            <li v-for="item in errors">{{ item }}</li>
                        </ul>
                    </template>
                    <div class="form-group">
                        <label for="name">Nome do produto</label>
                        <input :class="{'is-invalid': errors.name}" class="form-control " id="name" type="text"
                               v-model="product.name">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea :class="{'is-invalid': errors.description}" class="form-control" id="description"
                                  rows='5' type="text"
                                  v-model="product.description"
                        ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Preço</label>
                        <input :class="{'is-invalid': errors.price}" class="form-control" id="price"
                               placeholder="100,00 ou maior" type="text"
                               v-model="product.price">
                    </div>
                    <button class="btn btn-primary" type="submit">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            errors: [],
            product: {
                id: null,
                name: '',
                description: '',
                price: ''
            }
        }
    },

    mounted() {
        let id = window.location.search.replace("?", '');
        if (id) this.loadProduct(id);
    },

    methods: {
        submit() {
            let options = this.product.id
                ? {method: 'put', url: `/api/products/${this.product.id}`}
                : {method: 'post', url: '/api/products'}

            this.errors = []

            axios[options.method](options.url, {
                ...this.product
            }).then(() => {
                window.location = '/'
            }).catch((error) => {
                this.errors = Object.assign({}, this.errors, {...error.response.data.errors})
            })
        },

        loadProduct: function (id) {
            axios.get(`/api/products/${id}`)
                .then((response) => {
                    this.product = response.data
                })
                .catch(function (error) {
                    console.warn(error);
                })
        }
    }
};
</script>
