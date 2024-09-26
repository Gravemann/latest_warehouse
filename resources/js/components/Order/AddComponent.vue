<template>
    <div :class="this.$parent.addForm ? 'flex mb-6' : 'hidden'">
        <div class="flex-col">
            <form @submit.prevent="store">
                <p class="ml-1">Client</p>
                <select @click="getOptionsCount" id="select" v-model="client_id"
                    class="bg-black/60 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded">
                    <option class="text-slate-200" :value="null" selected disabled hidden>Please select the client</option>
                    <option v-for="client in clients" :value="client.id">{{ client.name }} {{ client.surname }} ({{ client.contact_number }})</option>
                </select>
                <div v-for="clientIdError in this.$parent.errors.client_id">
                    <div v-show="clientIdError" class="text-red-500 text-sm mb-1 ml-1">
                        {{ clientIdError }}
                    </div>
                </div>
                <p class="ml-1">Product</p>
                <select v-model="product_id"
                    class="bg-black/60 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded">
                    <option class="text-slate-200" :value="null" selected disabled hidden>Please select the product</option>
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
                            Add
                        </button>
                        <a href="#" @click.prevent="cancelAddForm" class="bg-transparent text-slate-200 leading-4 font-semibold px-4 py-2 border
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
                clients: [],
                client_id: null,
                products: [],
                product_id: null,
                quantity: null,
                product_quantity: null,
                label: 1
            }
        },

        methods: {
            addStoreForm() {
                this.$parent.addForm = true
                this.$parent.editForm = false
                this.client_id = null
                this.product_id = null
                this.quantity = null
                this.$parent.errors = ''
            },

            cancelAddForm() {
                this.$parent.addForm = false
                this.client_id = null
                this.product_id = null
                this.quantity = null
                this.$parent.errors = ''
            },

            watchAddForm() {
                axios.get(`api/all?page=${this.label}`, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.clients = res.data.clients
                    this.products = res.data.products
                    console.log(res)
                })
            },

            store() {
                this.products.forEach(product => {
                    if (product.id === this.product_id) {
                        this.product_quantity = product.quantity
                    }
                });
                axios.post('/api/orders', {
                    client_id: this.client_id,
                    product_id: this.product_id,
                    quantity: this.quantity,
                    product_quantity: this.product_quantity
                },  {
                        headers: {
                            'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.client_id = null,
                    this.product_id = null
                    this.quantity = null
                    this.product_quantity = null
                    this.$parent.errors = ''
                    this.$parent.addForm = false
                    this.$parent.successMessage = res.data.success
                    this.$parent.$refs.toastlist.$refs.s.getMessage()
                    setTimeout( () => this.$parent.successMessage = null, 2000)
                    this.$parent.getOrders()
                    this.$parent.$parent.$refs.statistics.getStatistics()
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