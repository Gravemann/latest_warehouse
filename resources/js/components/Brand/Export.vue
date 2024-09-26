<template>
    <div class="relative mb-12">
        <div class="absolute right-0">
            <form @submit.prevent="getImport">
                <!-- <input type="hidden" name="_token" :value="csrf"> -->
                <label v-show="!excel_import">
                    <input type="file" title="Choose importing file" @change="onImportChange" name="excel_import" ref="excel_import" class="form-control hidden">
                    <div class="border border-slate-200 rounded px-1 py-1 hover:bg-white/10 hover:text-indigo-400 hover:border-none hover:cursor-pointer" title="Choose importing file">
                        Import
                    </div>
                </label>
                <div v-show="excel_import" class="absolute right-0 flex space-x-1">
                    <button class="py-2 px-2 text-slate-200 bg-indigo-600 rounded" title="Import">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                        </svg>
                    </button>
                    <a href="#" @click.prevent="cancelImport" class="border-red-600 bg-red-600 text-slate-200 hover:cursor-pointer border rounded px-1.5 py-1.5" title="Cancel">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" width="20" height="20">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>
                </div>
            </form>
        </div>
    </div>
    <div class="relative pt-10">
        <div class="absolute flex bottom-0 right-0">
            <a v-show="!exporting" :href="getExport" @click="onExport" title="Export excel" class="hover:border-transparent duration-150 hover:bg-green-500 text-white border border-slate-200 font-bold py-2 px-2 mb-1 h-10 rounded content-center">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0,0,256,256">
                    <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(8.53333,8.53333)"><path d="M15,3c-0.13457,0.00082 -0.26871,0.01521 -0.40039,0.04297l-0.00195,-0.00195l-9.96875,1.99414l-0.00195,0.00195c-0.94311,0.17905 -1.62599,1.00293 -1.62695,1.96289v16c0.00021,0.9613 0.68429,1.78648 1.62891,1.96484l9.96875,1.99414c0.13238,0.02723 0.26719,0.04097 0.40234,0.04102c1.10457,0 2,-0.89543 2,-2v-20c0,-1.10457 -0.89543,-2 -2,-2zM19,5v3h2v2h-2v2h2v2h-2v2h2v2h-2v2h2v2h-2v3h6c1.105,0 2,-0.895 2,-2v-16c0,-1.105 -0.895,-2 -2,-2zM23,8h1c0.552,0 1,0.448 1,1c0,0.552 -0.448,1 -1,1h-1zM6.18555,10h2.40234l1.24414,2.99023c0.101,0.244 0.18177,0.52666 0.25977,0.84766h0.0332c0.045,-0.193 0.13353,-0.48609 0.26953,-0.87109l1.39063,-2.9668h2.1875l-2.61328,4.95508l2.69141,5.04297h-2.33398l-1.50391,-3.25781c-0.057,-0.115 -0.12369,-0.34697 -0.17969,-0.66797h-0.02148c-0.034,0.154 -0.10113,0.38631 -0.20313,0.69531l-1.51367,3.23242h-2.3457l2.7832,-5.00586zM23,12h1c0.552,0 1,0.448 1,1c0,0.552 -0.448,1 -1,1h-1zM23,16h1c0.552,0 1,0.448 1,1c0,0.552 -0.448,1 -1,1h-1zM23,20h1c0.552,0 1,0.448 1,1c0,0.552 -0.448,1 -1,1h-1z"></path></g></g>
                </svg>
            </a>
            <button v-show="exporting" class="flex hover:border-transparent duration-150 hover:bg-white/10 text-white border border-slate-200 font-bold py-2 px-4 mb-1 h-10 rounded items-center content-center">
                <svg class="animate-spin h-5 w-5 text-indigo-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="pl-2 text-indigo-400">Exporting...</span>
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                exporting: false,
                excel_import: null
            }
        },
        computed: {
            getExport() {
                return 'api/brands/export';
            },
        },

        methods: {
            onExport() {
                this.exporting = true
                setTimeout(() => {this.exporting = false}, 7000)
            },
            onImportChange(event) {
                this.excel_import = event.target.files[0]
            },
            cancelImport() {
                this.excel_import = null
                this.$refs.excel_import.value = null
            },
            getImport() {
                const data = new FormData;
                data.append('excel_import', this.excel_import)
                axios.post('api/brands/import', data, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.excel_import = null
                    this.$refs.excel_import.value = null
                    this.$parent.successMessage = res.data.success
                    this.$parent.$refs.toastlist.$refs.s.getMessage()
                    setTimeout( () => this.$parent.successMessage = null, 2000)
                    this.$parent.getBrands()
                    this.$parent.$parent.$refs.statistics.getStatistics()
                })
                .catch(err => {
                    this.excel_import = null
                    this.$refs.excel_import.value = null
                    this.$parent.errors = err.response.data.errors
                    this.$parent.failMessage = err.response.data.message
                    this.$parent.$refs.toastlist.$refs.d.getMessage()
                    setTimeout( () => this.$parent.failMessage = null, 2000)
                })
            },
        },
        props: [
            'csrf'
        ],
    }
</script>
