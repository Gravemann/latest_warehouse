<template>
    <table v-if="products" class="w-full whitespace-nowrap">
        <thead class="bg-black/60">
            <th class="text-left py-3 px-2 rounded-l-lg">Image</th>
            <th class="text-left py-3 px-2">
                <div @click.prevent="this.$parent.getFiltered(getSorted('brands.name'))" class="flex items-center cursor-pointer">
                    Brand
                    <div>
                        <svg v-if="column == 'brands.name' && order == 'ASC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                        </svg>
                        <svg v-if="column == 'brands.name' && order == 'DESC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                        </svg>
                    </div>
                </div>
            </th>
            <th class="text-left py-3 px-2">
                <div @click.prevent="this.$parent.getFiltered(getSorted('products.name'))" class="flex items-center cursor-pointer">
                    Name
                    <div>
                        <svg v-if="column == 'products.name' && order == 'ASC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                        </svg>
                        <svg v-if="column == 'products.name' && order == 'DESC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                        </svg>
                    </div>
                </div>
            </th>
            <th class="text-left py-3 px-2">
                <div @click.prevent="this.$parent.getFiltered(getSorted('products.purchase_price'))" class="flex items-center cursor-pointer">
                    Purchase Price
                    <div>
                        <svg v-if="column == 'products.purchase_price' && order == 'ASC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                        </svg>
                        <svg v-if="column == 'products.purchase_price' && order == 'DESC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                        </svg>
                    </div>
                </div>
            </th>
            <th class="text-left py-3 px-2">
                <div @click.prevent="this.$parent.getFiltered(getSorted('products.sale_price'))" class="flex items-center cursor-pointer">
                    Sales Price
                    <div>
                        <svg v-if="column == 'products.sale_price' && order == 'ASC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                        </svg>
                        <svg v-if="column == 'products.sale_price' && order == 'DESC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                        </svg>
                    </div>
                </div>
            </th>
            <th class="text-left py-3 px-2">
                <div @click.prevent="this.$parent.getFiltered(getSorted('products.quantity'))" class="flex items-center cursor-pointer">
                    Quantity
                    <div>
                        <svg v-if="column == 'products.quantity' && order == 'ASC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75 12 3m0 0 3.75 3.75M12 3v18" />
                        </svg>
                        <svg v-if="column == 'products.quantity' && order == 'DESC'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25 12 21m0 0-3.75-3.75M12 21V3" />
                        </svg>
                    </div>
                </div>   
            </th>
            <th class="text-left py-3 px-2 rounded-r-lg">Actions</th>
        </thead>
        <tr v-for="product in products" class="border-b border-gray-700">
            <td class="py-3 px-2 font-bold">
                <div class="w-32">
                    <span><img class="object-fill h-32" :src="product.image_url" alt=""></span>
                </div>
            </td>
            <td class="py-3 px-2">{{ product.brand }}</td>
            <td class="py-3 px-2">{{ product.name }}</td>
            <td class="py-3 px-2">{{ product.purchase_price }}</td>
            <td class="py-3 px-2">{{ product.sale_price }}</td>
            <td class="py-3 px-2">{{ product.quantity }}</td>
            <td class="py-3 px-2">
                <ActionsComponent :product="product" />
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
        'products',
    ],
}
</script>

<style>
    
</style>