<template>
    <div class="flex flex-row items-center">
        <div class="text-3xl">💰</div>
        <div class="p-2">
            <p class="text-xl font-bold text-center">{{ current_profit }}</p>
            <p class="text-slate-200 text-sm text-center">Current profit</p>
        </div>
    </div>
    <!-- <div class="p-2">
        <p class="text-xl font-bold text-center">{{ current_profit }}</p>
        <p class="text-slate-200 text-sm text-center">Current profit</p>
    </div> -->
</template>

<script>
    export default {
        data() {
            return {
                data: null,
                current_profit: null
            }
        },

        created() {
            this.getFinancial()
        },

        methods: {
            async getFinancial() {
                const get_token = await axios.get('/access_token')

                if (localStorage.getItem('api_key')) {

                } else {
                    localStorage.setItem('api_key', get_token.data.api_token)
                }
                const c_profit = await axios.get('/api/financial_statistics', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })

                this.current_profit = c_profit.data.current_profit
            },
            
        },
    }
</script>

<style>
    
</style>