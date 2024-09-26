<template>
    <div id="24h">
        <h1 class="font-bold py-4 uppercase">Statistics</h1>
        <div id="stats" class="grid gird-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-black/60 to-white/5 p-6 rounded-lg">
                <div class="flex flex-row space-x-4 items-center">
                    <div id="stats-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                            stroke="currentColor" class="w-10 h-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg> 
                    </div>
                    <div>
                        <p class="text-indigo-300 text-sm font-medium uppercase leading-4">Brands</p>
                        <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                            <span v-if="stats">{{ stats.brands }}</span>
                            <span>
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                </svg> -->
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-black/60 p-6 rounded-lg">
                <div class="flex flex-row space-x-4 items-center">
                    <div id="stats-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                            stroke="currentColor" class="w-10 h-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-teal-300 text-sm font-medium uppercase leading-4">Products</p>
                        <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                            <span v-if="stats">{{ stats.products }}</span>
                            <span>
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                </svg> -->

                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-black/60 p-6 rounded-lg">
                <div class="flex flex-row space-x-4 items-center">
                    <div id="stats-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                            stroke="currentColor" class="w-10 h-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-blue-300 text-sm font-medium uppercase leading-4">Clients</p>
                        <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                            <span v-if="stats">{{ stats.clients }}</span>
                            <span>
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                </svg> -->

                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="bg-black/60 p-6 rounded-lg">
                <div class="flex flex-row space-x-4 items-center">
                    <div id="stats-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                            stroke="currentColor" class="w-10 h-10 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                            d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-teal-300 text-sm font-medium uppercase leading-4">Orders</p>
                        <p class="text-white font-bold text-2xl inline-flex items-center space-x-2">
                            <span v-if="stats">{{ stats.orders }}</span>
                            <span>
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                                </svg> -->

                            </span>
                        </p>
                    </div>
                </div>
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
            this.getStatistics()
        },

        methods: {
           async getStatistics() {
            const get_token = await axios.get('/access_token')

            if (localStorage.getItem('api_key')) {

            } else {
                localStorage.setItem('api_key', get_token.data.api_token)
            }
            
            const stats = await axios.get('api/statistics', {
                headers: {
                    'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                }
            })
            this.stats = stats.data
            },
        },
    }
</script>

<style>
    
</style>