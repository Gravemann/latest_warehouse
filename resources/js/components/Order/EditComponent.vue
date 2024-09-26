<template >
    <div :class="this.$parent.editForm ? 'flex mb-6' : 'hidden'">
        <div class="flex-col">
            <form @submit.prevent="update(id)">
                <p class="ml-1">Client</p>
                <select v-model="client_id"
                    class="bg-black/60 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded">
                    <option v-if="client_id == null" class="text-slate-200" :value="null" selected disabled hidden>Please select the client</option>
                    <option v-for="client in clients" :value="client.id">{{ client.name }} {{ client.surname }}</option>
                </select>
                <div v-for="clientIdError in this.$parent.errors.client_id">
                    <div v-show="clientIdError" class="text-red-500 text-sm mb-1 ml-1">
                        {{ clientIdError }}
                    </div>
                </div>
                <p class="ml-1">Product</p>
                <select v-model="product_id"
                    class="bg-black/60 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded">
                    <option v-if="product_id == null" class="text-slate-200" :value="null" selected disabled hidden>Please select the product</option>
                    <option v-for="product in products" :value="product.id">{{ product.brand }} - {{ product.name }} - [{{ product.quantity }}]</option>
                </select>
                <div v-for="productIdError in this.$parent.errors.product_id">
                    <div v-show="productIdError" class="text-red-500 text-sm mb-1 ml-1">
                        {{ productIdError }}
                    </div>
                </div>
                <p class="ml-1">Quantity</p>
                <input v-model="quantity"
                    class="bg-black/60 font-semibold text-slate-200 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded"
                    type="number" name="quantity">
                <div v-for="quantityError in this.$parent.errors.quantity">
                    <div v-show="quantityError" class="text-red-500 text-sm mb-1 ml-1">
                        {{ quantityError }}
                    </div>
                </div>
                <div class="flex-col mt-3">
                    <div class="flex items-center space-x-10">
                        <button class="bg-transparent ml-1 text-slate-200 leading-4 font-semibold px-4 py-2 border
                        border-slate-200 hover:border-transparent rounded
                        hover:text-indigo-400 transition duration-150 hover:bg-white/10 ease-linear cursor-pointer">
                            Update
                        </button>
                        <a href="#" @click.prevent="cancelEditForm" class="bg-transparent text-slate-200 leading-4 font-semibold px-4 py-2 border
                        border-slate-200 hover:border-transparent rounded  
                        hover:text-indigo-400 transition duration-150 hover:bg-white/10 ease-linear cursor-pointer">
                            Cancel
                        </a>
                    </div>
                </div>
            </form>
        </div>
        </div>
</template>

<script>
    export default {
        data() {
            return {
                clients: null,
                client_id: null,
                products: null,
                product_id: null,
                quantity: null,
                product_quantity: null,
            }
        },

        methods: {
            changeUpdateOrderId(id, client_id, product_id, quantity, product_quantity) {
                axios.get('api/all', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    console.log(res)
                    this.clients = res.data.clients
                    this.products = res.data.products
                })
                this.$parent.editForm = true
                this.$parent.addForm = false
                this.editId = id
                this.client_id = client_id
                this.product_id = product_id
                this.quantity = quantity
                this.product_quantity = product_quantity
            },

            cancelEditForm() {
                this.$parent.editForm = false
                this.$parent.editId = ''
                this.client_id = null
                this.product_id = null
                this.quantity = ''
                this.$parent.errors = ''
            },

            update(id) {
                id = this.editId
                this.products.forEach(product => {
                    if (product.id === this.product_id) {
                        this.product_quantity = product.quantity
                    }
                });
                axios.patch(`/api/orders/${id}`, {
                    client_id: this.client_id,
                    product_id: this.product_id,
                    quantity: this.quantity,
                    product_quantity: this.product_quantity,
                }, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.$parent.editId = ''
                    this.client_id = null,
                    this.product_id = null
                    this.quantity = ''
                    this.product_quantity = ''
                    this.$parent.errors = ''
                    this.$parent.editForm = false
                    this.$parent.successMessage = res.data.success
                    this.$parent.failMessage = res.data.fail
                    this.$parent.$refs.toastlist.$refs.s.getMessage()
                    this.$parent.$refs.toastlist.$refs.d.getMessage()
                    setTimeout( () => this.$parent.successMessage = null, 2000)
                    setTimeout( () => this.$parent.failMessage = null, 2000)
                    this.$parent.getOrders()
                    this.$parent.$parent.$refs.incomes.getFinancial()
                })
                .catch(err => {
                    this.$parent.errors = err.response.data.errors
                    if (this.$parent.errors.client_id) {
                        this.client_id = null
                    } else if (this.$parent.errors.product_id) {
                        this.product_id = null
                    } else if (this.$parent.errors.quantity) {
                        this.quantity = ''
                    }
                })
            },
        },
    }
</script>
