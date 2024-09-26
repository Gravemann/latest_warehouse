<template>
    <div>
        <template v-if="order.confirmed == 0">
            <div :class="isDelete(order.id) ? 'hidden' : 'inline-flex items-center space-x-3'">
                <a href="" @click.prevent="this.$parent.$parent.$refs.edit.changeUpdateOrderId(order.id, order.client.id, order.product.id, order.quantity, order.product.quantity)"
                        title="Edit" class="hover:text-white"><svg xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 group-hover:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                    </svg>
                </a>
                <a href="" @click.prevent="changeDeleteOrderId(order.id)" title="Delete" class="hover:text-white"><svg xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        class="w-5 h-5 group-hover:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                    </svg>
                </a>
                <a href="" @click.prevent="confirmOrder(order.id)" title="Confirm" class="hover:text-white"><svg xmlns="http://www.w3.org/2000/svg" 
                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                        class="w-5 h-5 group-hover:text-indigo-400">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </a>
            </div>
            <div :class="isDelete(order.id) ? 'inline-flex items-center space-x-3' : 'hidden'">
                <a href="#" @click.prevent="deleteOrder(order.id)" title="Confirm" class="hover:text-white"><svg 
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </a>
                <a href="#" @click.prevent="cancelDelete" title="Cancel" class="hover:text-white"><svg
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor"
                        class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </a>
            </div>
        </template>
        <template v-else>
            <a href="" @click.prevent="unconfirmOrder(order.id)" title="Unconfirm" class="hover:text-white"><svg
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor"
                    class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                </svg>
            </a>
        </template>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                editId: null,
                deleteId: null,
                confirmId: null,
            }
        },

        methods: {
            changeDeleteOrderId(id) {
                this.deleteId = id
            },

            isDelete(id) {
                return this.deleteId === id
            },

            deleteOrder(id) {
                axios.delete(`/api/orders/${id}`, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.$parent.$parent.successMessage = res.data.deleted
                    this.$parent.$parent.$refs.toastlist.$refs.s.getMessage()
                    setTimeout( () => this.$parent.$parent.successMessage = null, 2000)
                    this.deleteId = ''
                    this.$parent.$parent.getOrders()
                    this.$parent.$parent.$parent.$refs.statistics.getStatistics()
                    this.$parent.$parent.$parent.$refs.incomes.getFinancial()
                })
            },

            cancelDelete() {
                this.deleteId = null
            },

            confirmOrder(id) {
                this.confirmId = id
                axios.patch(`/api/orders/confirm/${id}`, {}, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.$parent.$parent.successMessage = res.data.success
                    this.$parent.$parent.failMessage = res.data.fail
                    this.$parent.$parent.$refs.toastlist.$refs.s.getMessage()
                    this.$parent.$parent.$refs.toastlist.$refs.d.getMessage()
                    setTimeout( () => this.$parent.$parent.successMessage = null, 2000)
                    setTimeout( () => this.$parent.$parent.failMessage = null, 2000)
                    this.confirmId = ''
                    this.$parent.$parent.getOrders()
                    this.$parent.$parent.$parent.$refs.current_profit.getFinancial()
                })
            },

            unconfirmOrder(id) {
                this.confirmId = id
                axios.patch(`/api/orders/unconfirm/${id}`, {}, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.$parent.$parent.successMessage = res.data.success
                    this.$parent.$parent.$refs.toastlist.$refs.s.getMessage()
                    setTimeout( () => this.$parent.$parent.successMessage = null, 2000)
                    this.confirmId = ''
                    this.$parent.$parent.getOrders()
                    this.$parent.$parent.$parent.$refs.current_profit.getFinancial()
                })
            },
        },

        props: [
            'order',
        ],
    }
</script>
