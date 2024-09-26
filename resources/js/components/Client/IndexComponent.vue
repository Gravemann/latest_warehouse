<template>
    <table v-if="clients" class="w-full whitespace-nowrap">
        <thead class="bg-black/60">
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
                <div @click.prevent="this.$parent.getFiltered(getSorted('surname'))" class="flex items-center cursor-pointer">
                    Surname
                    <div>
                        <svg v-if="column == 'surname' && order == 'ASC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                        </svg>
                        <svg v-if="column == 'surname' && order == 'DESC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                        </svg>
                    </div>
                </div>
            </th>
            <th class="text-left py-3 px-2">Contact number</th>
            <th class="text-left py-3 px-2">
                <div @click.prevent="this.$parent.getFiltered(getSorted('company'))" class="flex items-center cursor-pointer">
                    Company
                    <div>
                        <svg v-if="column == 'company' && order == 'ASC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                        </svg>
                        <svg v-if="column == 'company' && order == 'DESC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                        </svg>
                    </div>
                </div>
            </th>
            <th class="text-left py-3 px-2 rounded-r-lg">Actions</th>
        </thead>
        <tr v-for="client in clients" class="border-b border-gray-700">
            <td class="py-3 px-2 font-bold">
                <div class="w-32">
                    <span><img class="object-fill h-32" :src="client.image_url" alt=""></span>
                </div>
            </td>
            <td class="py-3 px-2">{{ client.name }}</td>
            <td class="py-3 px-2">{{ client.surname }}</td>
            <td class="py-3 px-2">{{ client.contact_number }}</td>
            <td class="py-3 px-2">{{ client.company }}</td>
            <td class="py-3 px-2">
                <ActionsComponent :client="client" />
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
        'clients',
    ],
}
</script>

<style>
    
</style>