<template>
    <div :class="this.$parent.addForm ? 'flex mb-6' : 'hidden'">
        <div class="flex-col">
            <form @submit.prevent="store">
                <p class="ml-1">Brand</p>
                <select v-model="brand_id"
                    class="bg-black/60 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded">
                    <option class="text-slate-200" :value="null" selected disabled hidden>Please select the brand</option>
                    <option v-for="brand in brands" :value="brand.id">{{ brand.name }}</option>
                </select>
                <div v-for="brandIdError in this.$parent.errors.brand_id">
                    <div v-show="brandIdError" class="text-red-500 text-sm mb-1 ml-1">
                        {{ brandIdError }}
                    </div>
                </div>
                <p class="ml-1">Name</p>
                <input v-model="name"
                    class="bg-black/60 font-semibold text-slate-200 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded"
                    type="text" name="name">
                <div v-for="nameError in this.$parent.errors.name">
                    <div v-show="nameError" class="text-red-500 text-sm mb-1 ml-1">
                        {{ nameError }}
                    </div>
                </div>
                <p class="ml-1">Purchase price</p>
                <input v-model="purchase_price"
                    class="bg-black/60 font-semibold text-slate-200 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded"
                    type="number" name="purchase_price">
                <div v-for="purchasePriceError in this.$parent.errors.purchase_price">
                    <div v-show="purchasePriceError" class="text-red-500 text-sm mb-1 ml-1">
                        {{ purchasePriceError }}
                    </div>
                </div>
                <p class="ml-1">Sale price</p>
                <input v-model="sale_price"
                    class="bg-black/60 font-semibold text-slate-200 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded"
                    type="number" name="sale_price">
                <div v-for="salePriceError in this.$parent.errors.sale_price">
                    <div v-show="salePriceError" class="text-red-500 text-sm mb-1 ml-1">
                        {{ salePriceError }}
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
                <div>
                    <input type="file" name="image" @change="onFileChange" class="text-sm text-slate-200 mb-6 ml-1
                    file:mr-5 file:py-2 file:px-6
                    file:rounded file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 border-slate-200 file:text-blue-700
                    hover:file:border-transparent hover:file:text-indigo-400
                    hover:file:bg-white/10 transition">
                </div>
                <div v-for="imageError in this.$parent.errors.image">
                    <div v-show="imageError" class="text-red-500 text-sm mb-1 ml-1">
                        {{ imageError }}
                    </div>
                </div>
                <div v-if="imagePreview" class="w-40 ml-1">
                    <img :src="imagePreview" class="object-fill h-40">
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
                brands: null,
                brand_id: null,
                name: null,
                purchase_price: null,
                sale_price: null,
                quantity: null,
                image: null,
                imagePreview: null,
            }
        },

        methods: {
            addStoreForm() {
                axios.get('api/all', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.brands = res.data.brands
                })
                this.$parent.addForm = true
                this.$parent.editForm = false
                this.brand_id = null
                this.name = ''
                this.purchase_price = ''
                this.sale_price = ''
                this.quantity = ''
                this.image = ''
                this.imagePreview = ''
                this.$parent.errors = ''
            },

            cancelAddForm() {
                this.$parent.addForm = false
                this.brand_id = null
                this.name = null
                this.purchase_price = null
                this.sale_price = null
                this.quantity = null
                this.image = null
                this.imagePreview = null
                this.$parent.errors = ''
            },
            onFileChange(event) {
                this.image = event.target.files[0]
                const reader = new FileReader()
                reader.readAsDataURL(this.image)
                reader.onload = event => {
                    this.imagePreview = event.target.result
                }
            },

            store() {
                const data = new FormData
                if (this.brand_id == null) {
                    data.append('brand_id', '')
                } else {
                    data.append('brand_id', this.brand_id)
                }
                data.append('name', this.name)
                data.append('purchase_price', this.purchase_price)
                data.append('sale_price', this.sale_price)
                data.append('quantity', this.quantity)
                data.append('image', this.image)
                axios.post('/api/products', data, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                    .then(res => {
                        this.brand_id = null
                        this.name = null
                        this.purchase_price = null
                        this.sale_price = null
                        this.quantity = null
                        this.image = null
                        this.imagePreview = null
                        this.$parent.errors = ''
                        this.$parent.addForm = false
                        this.$parent.successMessage = res.data.success
                        this.$parent.$refs.toastlist.$refs.s.getMessage()
                        setTimeout( () => this.$parent.successMessage = null, 2000)
                        this.$parent.getProducts()
                        this.$parent.$parent.$refs.statistics.getStatistics()
                        this.$parent.$parent.$refs.incomes.getFinancial()
                    })
                    .catch(err => {
                        this.$parent.errors = err.response.data.errors
                        if (this.$parent.errors.brand_id) {
                            this.brand_id = null
                        } else if (this.$parent.errors.name) {
                            this.name = ''
                        } else if (this.$parent.errors.purchase_price) {
                            this.purchase_price = ''
                        } else if (this.$parent.errors.sale_price) {
                            this.sale_price = ''
                        } else if (this.$parent.errors.quantity) {
                            this.quantity = ''
                        } else if (this.$parent.errors.image) {
                            this.image = ''
                        }
                    })
            },  
        },
    }
</script>