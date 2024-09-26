<template>
    <ToastList ref="toastlist" />
    <div id="table-list">
        <h1 class="font-bold py-4 uppercase text-center">Clients</h1>
        <div>
            <div class="flex flex-col items-center pb-4">
                <a href="#" @click.prevent="this.$refs.add.addStoreForm"
                    :class="addForm ? 'hidden' : 'bg-transparent text-slate-200 leading-4 font-semibold px-4 py-2 border border-slate-200 hover:border-transparent rounded hover:bg-white/10 hover:text-indigo-400 transition duration-150 ease-linear cursor-pointer'">Add</a>    
                <div v-if="filtered" class="mr-auto pt-3">
                    {{ filtered }}
                </div>
            </div>

            <!-- Add form -->

            <AddComponent ref="add" />

            <!-- Edit form -->

            <EditComponent ref="edit" />

            <!-- Search -->

            <LiveSearchComponent ref="search"/>

            <!-- Index part -->

            <IndexComponent :clients="clients" ref="index"/>

            <!-- Pagination -->
            
            <Pagination v-if="pagination" :data="pagination" ref="pagination" />
        </div>
    </div>

</template>

<script>
import AddComponent from './AddComponent.vue'
import EditComponent from './EditComponent.vue';
import IndexComponent from './IndexComponent.vue';
import LiveSearchComponent from './LiveSearchComponent.vue';
import Pagination from './Pagination.vue';
import ToastList from './toasts/ToastList.vue';



export default {
    data() {
        return {
            clients: null,
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
        this.getClients();
    },
    methods: {
        getClients(label) {
            axios.get(`api/clients?page=${label}`, {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                }
            })
            .then(res => {
                this.clients = res.data.data
                this.pagination = res.data.meta;
                this.addForm = false;
                this.editForm = false;
            });
        },

        getFiltered(label = 1) {
            axios.get(`api/clients/livesearch?page=${label}`, { 
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
                this.clients = res.data.data
                this.pagination = res.data.meta
                if (this.$refs.search.keyword) {
                    if (res.data.meta.total > 1) {
                        this.filtered = `Found ${res.data.meta.total} clients`
                    } else if (res.data.meta.total == 1) {
                        this.filtered = `Found ${res.data.meta.total} client`
                    } else {
                        this.filtered = 'No matching data found'
                    }
                } else {
                    this.filtered = null
                }
            })
        }
    },
    components: {
        AddComponent,
        EditComponent,
        IndexComponent,
        Pagination,
        ToastList,
        LiveSearchComponent
    }
}
</script>

<style>

</style>