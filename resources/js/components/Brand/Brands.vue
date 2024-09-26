<template>
    <ToastList ref="toastlist" />
    <div id="table-list">
        <h1 class="font-bold py-4 uppercase text-center">Brands</h1>
        <div>
            <div class="flex flex-col items-center pb-4">
                <a href="#" @click.prevent="this.$refs.add.addStoreForm"
                    :class="addForm ? 'hidden' : ' bg-transparent text-slate-200 leading-4 font-semibold px-4 py-2 border border-slate-200 hover:border-transparent rounded hover:bg-white/10 hover:text-indigo-400 duration-150 ease-linear cursor-pointer'">Add</a>    
                <div v-if="filtered" class="mr-auto pt-3">
                    {{ filtered }}
                </div>
            </div>

            <!-- Add form -->

            <AddComponent ref="add" />

            <!-- Edit form -->

            <EditComponent ref="edit" />

            <!-- Search -->

            <LiveSearchComponent ref="search" />

            <!-- Export -->

            <Export :csrf="csrf"/>

            <!-- Index part -->

            <IndexComponent :brands="brands" ref="index" />

            <!-- Pagination -->

            <Pagination v-if="pagination" :data="pagination" ref="pagination" />

            
        </div>
    </div>

</template>

<script>
import ToastList from './toasts/ToastList.vue'
import AddComponent from './AddComponent.vue'
import EditComponent from './EditComponent.vue'
import IndexComponent from './IndexComponent.vue'
import Pagination from './Pagination.vue'
import LiveSearchComponent from './LiveSearchComponent.vue'
import axios from 'axios'
import Export from './Export.vue'

export default {
    data() {
        return {
            brands: null,
            pagination: null,
            addForm: false,
            editForm: false,
            errors: '',
            successMessage: null,
            failMessage: null,
            filtered: null
        };
    },
    
    created() {
        this.getBrands()
    },

    methods: {
        async getBrands(label = 1) {
            const get_token = await axios.get('/access_token')

            if (localStorage.getItem('api_key')) {

            } else {
                localStorage.setItem('api_key', get_token.data.api_token)
            }

            const brands_data = await axios.get(`api/brands?page=${label}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_key')}` 
                }
            })
            this.addForm = false
            this.brands = brands_data.data.data;
            this.pagination = brands_data.data.meta;
            this.errors = ''
            setTimeout( () => this.successMessage = null, 2000)
            setTimeout( () => this.failMessage = null, 2000)
        },

        getFiltered(label = 1) {
            axios.get(`api/brands/livesearch?page=${label}`, { 
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                },
                params: {
                    keyword: this.$refs.search.keyword,
                    column: this.$refs.index.column,
                    order: this.$refs.index.order
                }
            })
            .then(res => {
                this.brands = res.data.data
                this.pagination = res.data.meta
                if (this.$refs.search.keyword) {
                    if (res.data.meta.total > 1) {
                        this.filtered = `Found ${res.data.meta.total} brands`
                    } else if (res.data.meta.total == 1) {
                        this.filtered = `Found 1 brand`
                    } else {
                        this.filtered = 'No matching data found'
                    }
                } else {
                    this.filtered = null
                }
            })
        },
    },
    props:[
        'csrf'
    ],
    components: {
        AddComponent,
        EditComponent,
        IndexComponent,
        Pagination,
        ToastList,
        LiveSearchComponent,
        Export
    },
}
</script>

<style>

</style>