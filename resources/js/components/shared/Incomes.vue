<template>
    <div v-if="stats" class="bg-black/60 to-white/5 rounded-lg">
        <div class="flex flex-row items-center">
            <div class="text-3xl">💰</div>
            <div class="p-2">
                <p class="text-xl font-bold text-center">{{ stats.purchase }}</p>
                <p class="text-slate-200 text-sm text-center">Purchase</p>
            </div>
        </div>
    </div>
    <div v-if="stats" class="bg-black/60 to-white/5 rounded-lg">
        <div class="flex flex-row items-center">
            <div class="text-3xl">💰</div>
            <div class="p-2">
                <p class="text-xl font-bold text-center">{{ stats.sale }}</p>
                <p class="text-slate-200 text-sm text-center">Sale</p>
            </div>
        </div>
    </div>
    <div v-if="stats" class="bg-black/60 to-white/5 rounded-lg">
        <div class="flex flex-row items-center">
            <div class="text-3xl">💰</div>
            <div class="p-2">
                <p class="text-xl font-bold text-center">{{ stats.ordered }}</p>
                <p class="text-slate-200 text-sm text-center">Ordered</p>
            </div>
        </div>
    </div>
    <div v-if="stats" class="bg-black/60 to-white/5 rounded-lg">
        <div class="flex flex-row items-center">
            <div class="text-3xl">💰</div>
            <div class="p-2">
                <p class="text-xl font-bold text-center">{{ stats.profit }}</p>
                <p class="text-slate-200 text-sm text-center">Profit</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                stats: null
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
                const stats = axios.get('/api/financial_statistics', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.stats = res.data
                })
            },
        },
    }
</script>

<style>
    
</style>