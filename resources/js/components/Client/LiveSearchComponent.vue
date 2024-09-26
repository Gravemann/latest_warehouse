<template>
    <div class="relative pb-4">
        <div class="absolute bottom-0 right-0 pb-4">
            <label>
                Search:
                <input v-model="keyword" @input="onKeywordChange" type="search"  class="bg-black/60 font-semibold border-slate-200 border rounded h-8 w-40">
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                keyword: null
            }
        },

        watch: {
            keyword(after, before) {
                this.$parent.getFiltered()
            }
        },

        methods: {
            onKeywordChange(event) {
                if (event.target.value.length === 0) {
                    this.keyword = null
                }
            },
        },
    }
</script>
