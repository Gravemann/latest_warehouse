<template>
    <table v-if="brands" class="w-full whitespace-nowrap">
        <thead class="bg-black/60 text-slate-300">
            <th class="text-left py-3 px-2 rounded-l-lg">Image</th>
            <th class="text-left py-3 px-2">
                <div @click.prevent="this.$parent.getFiltered(getSorted('name'))" class="flex items-center cursor-pointer">
                    Name
                    <div>
                        <svg v-if="column == 'name' && order == 'ASC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                        </svg>
                        <svg v-if="column == 'name' && order == 'DESC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                        </svg>
                    </div>
                </div>
            </th>
            <th class="text-left py-3 px-2">
                <div @click.prevent="this.$parent.getFiltered(getSorted('created_at'))" class="flex items-center cursor-pointer">
                    Added
                    <div>
                        <svg v-if="column == 'created_at' && order == 'ASC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                        </svg>
                        <svg v-if="column == 'created_at' && order == 'DESC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                        </svg>
                    </div>
                </div>
            </th>
            <th class="text-left py-3 px-2">
                <div @click.prevent="this.$parent.getFiltered(getSorted('updated_at'))" class="flex items-center cursor-pointer">
                    Updated
                    <div>
                        <svg v-if="column == 'updated_at' && order == 'ASC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                        </svg>
                        <svg v-if="column == 'updated_at' && order == 'DESC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                        </svg>
                    </div>
                </div>
            </th>
            <th class="text-left py-3 px-2 rounded-r-lg">Actions</th>
        </thead>
        <tr v-for="brand in brands" class="border-b border-gray-700 text-slate-300">
            <td class="py-3 px-2 font-bold">
                <div class="w-32">
                    <span><img class="object-fill h-32" :src="brand.image_url" alt=""></span>
                </div>
            </td>
            <td class="py-3 px-2">{{ brand.name }}</td>
            <td class="py-3 px-2">{{ brand.created_at }}</td>
            <td class="py-3 px-2">{{ brand.updated_at }}</td>
            <td class="py-3 px-2">
                <ActionsComponent :brand="brand" />
            </td>
        </tr>
    </table>
</template>

<script>
import ActionsComponent from './ActionsComponent.vue';

export default {
    components: {
        ActionsComponent,
    },

    data() {
        return {
            column: null,
            order: null
        }
    },

    methods: {
        getSorted(column) {
            if (this.order === null && this.column === null 
                || this.order === 'ASC' && this.column !== column 
                || this.order === 'DESC' && this.column !== column) {
                    this.column = column
                    this.order = 'ASC'
            } else if (this.order === 'ASC' && this.column === column) {
                this.order = 'DESC' 
            } else if (this.order === 'DESC' && this.column === column) {
                this.column = null
                this.order = null
            }
        },
    },

    props: [
        'brands',
    ],
}
</script>

<style>
    
</style>