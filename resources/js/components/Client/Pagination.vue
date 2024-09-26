<template>
    <div v-if="data.links.length > 3" class="bg-transparent px-4 pt-5 grid justify-items-center border-gray-200 sm:px-6">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                    <!-- active - text-blue-500 font-bold -->
                    <!-- url null - bg-gray-100 -->
                    <a
                        :class="data.links[0].url === null 
                            ? 'bg-transparent border-gray-300 text-slate-200 relative inline-flex items-center px-4 py-2 border text-sm font-medium pointer-events-none' 
                            : 'bg-transparent border-gray-300 text-slate-200 hover:bg-indigo-400 relative inline-flex items-center px-4 py-2 border text-sm font-medium cursor-pointer'"
                        v-on:click.prevent="this.$parent.$refs.search.keyword === null && this.$parent.$refs.index.column === null 
                            ? data.links[0].url !== null && this.$parent.getClients(data.current_page - 1) 
                            : data.links[0].url !== null && this.$parent.getFiltered(data.current_page - 1)"
                        v-html="data.links[0].label">
                    </a>
                    <template v-for="link in data.links">
                        <template v-if="Number(link.label)"> 
                            <a
                                v-html="link.label"
                                v-on:click.prevent="this.$parent.$refs.search.keyword === null && this.$parent.$refs.index.column === null 
                                    ? this.$parent.getClients(link.label)
                                    : this.$parent.getFiltered(link.label)"
                                :class="link.active 
                                    ? 'bg-indigo-400 border-gray-300 text-slate-200 hover:bg-indigo-400 relative inline-flex items-center px-4 py-2 border text-sm font-medium' 
                                    : 'bg-transparent border-gray-300 text-slate-200 hover:bg-indigo-400 relative inline-flex items-center px-4 py-2 border text-sm font-medium cursor-pointer'"
                            >   
                            </a> 
                        </template>
                    </template>
                    <a
                        :class="data.links[data.links.length - 1].url === null 
                            ? 'bg-transparent border-gray-300 text-slate-200 relative inline-flex items-center px-4 py-2 border text-sm font-medium'
                            : 'bg-transparent border-gray-300 text-slate-200 hover:bg-indigo-400 relative inline-flex items-center px-4 py-2 border text-sm font-medium cursor-pointer'"
                        v-on:click.prevent="this.$parent.$refs.search.keyword === null && this.$parent.$refs.index.column === null 
                            ? data.links[data.links.length - 1].url !== null && this.$parent.getClients(data.current_page + 1) 
                            : data.links[data.links.length - 1].url !== null && this.$parent.getFiltered(data.current_page + 1)"
                        v-html="data.links[data.links.length - 1].label">
                    </a>
                    <!-- <Link v-for="(link, k) in links"
                      :href="link.url"
                      :key="k"
                      :disabled="link.url === null"
                      :class="{'text-blue-500 font-bold': link.active, 'bg-gray-100': link.url === null}"
                       v-html="link.label"
                       class="bg-white border-gray-300 text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                    />  -->
                </nav>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props: [
        'data',
    ],
};
</script>