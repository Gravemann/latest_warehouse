<template>

    <div id="table-list">
        <h1 class="font-bold py-4 uppercase text-center">Brands</h1>
        <div>
            <div class="flex flex-col items-center pb-4">
                <a href="#" @click.prevent="addBrandForm"
                    :class="addForm ? 'hidden' : ' bg-transparent text-slate-200 leading-4 font-semibold px-4 py-2 border border-slate-200 hover:border-transparent rounded hover:bg-white/10 hover:text-indigo-400 transition duration-150 ease-linear cursor-pointer'">Add</a>
                <transition name="fade">
                    <div v-if="successMessage || deleteMessage" class="mt-4 h-10 text-center pt-2 text-indigo-400 bg-white/10 shadow-lg rounded-lg font-semibold">
                        {{ successMessage }}
                        {{ deleteMessage }}
                    </div>
                </transition>     
            </div>

            <!-- Add form -->

            <div :class="addForm ? 'flex mb-6' : 'hidden'">
                <div class="flex-col">
                    <form @submit.prevent="store">
                        <p class="ml-1">Name</p>
                        <input v-model="name"
                            class="bg-black/60 font-semibold text-slate-200 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded"
                            type="text" name="name">
                        <div v-for="nameError in errors.name">
                            <div v-show="nameError" class="text-red-500 text-sm mb-4 ml-1">
                                {{ nameError }}
                            </div>
                        </div>
                        <div>
                            <input type="file" name="image" @change="onFileChange" class="text-sm text-slate-200 mb-6 ml-1
                    file:mr-5 file:py-2 file:px-6
                    file:rounded file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 border-slate-200 file:text-blue-700
                    hover:file:border-transparent hover:file:text-indigo-400
                    hover:file:bg-white/10 transition">
                        </div>
                        <div v-if="imagePreview" class="w-40 ml-1">
                            <img :src="imagePreview" class="object-fill h-40">
                        </div>
                        <div v-for="imageError in errors.image">
                            <div v-show="imageError" class="text-red-500 text-sm ml-1">
                                {{ imageError }}
                            </div>
                        </div>
                        <div class="flex-col mt-3">
                            <div class="flex items-center space-x-10">
                                <button class="bg-transparent ml-1 text-slate-200 leading-4 font-semibold px-4 py-2 border
                    border-slate-200 hover:border-transparent rounded
                    hover:text-indigo-400 transition duration-150 hover:bg-white/10 ease-linear cursor-pointer">
                                    Confirm
                                </button>
                                <a href="#" @click.prevent="cancelAddForm" class="bg-transparent text-slate-200 leading-4 font-semibold px-4 py-2 border
                    border-slate-200 hover:border-transparent rounded  
                    hover:text-indigo-400 transition duration-150 hover:bg-white/10 ease-linear cursor-pointer">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit form -->

            <div :class="editForm ? 'flex mb-6' : 'hidden'">
                <div class="flex-col">
                    <form @submit.prevent="store">
                        <p class="ml-1">Name</p>
                        <input v-model="name"
                            class="bg-black/60 font-semibold text-slate-200 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded"
                            type="text" name="name">
                        <div v-for="nameError in errors.name">
                            <div v-show="nameError" class="text-red-500 text-sm mb-4 ml-1">
                                {{ nameError }}
                            </div>
                        </div>
                        <div>
                            <input type="file" name="image" @change="onFileChange" class="text-sm text-slate-200 mb-6 ml-1
                    file:mr-5 file:py-2 file:px-6
                    file:rounded file:border-0
                    file:text-sm file:font-semibold
                    file:bg-blue-50 border-slate-200 file:text-blue-700
                    hover:file:border-transparent hover:file:text-indigo-400
                    hover:file:bg-white/10 transition">
                        </div>
                        <div v-if="imagePreview" class="w-40 ml-1">
                            <img :src="imagePreview" class="object-fill h-40">
                        </div>
                        <div v-for="imageError in errors.image">
                            <div v-show="imageError" class="text-red-500 text-sm ml-1">
                                {{ imageError }}
                            </div>
                        </div>
                        <div class="flex-col mt-3">
                            <div class="flex items-center space-x-10">
                                <button class="bg-transparent ml-1 text-slate-200 leading-4 font-semibold px-4 py-2 border
                    border-slate-200 hover:border-transparent rounded
                    hover:text-indigo-400 transition duration-150 hover:bg-white/10 ease-linear cursor-pointer">
                                    Confirm
                                </button>
                                <a href="#" @click.prevent="cancelEditForm" class="bg-transparent text-slate-200 leading-4 font-semibold px-4 py-2 border
                    border-slate-200 hover:border-transparent rounded  
                    hover:text-indigo-400 transition duration-150 hover:bg-white/10 ease-linear cursor-pointer">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Index part -->

            <table v-if="brands" class="w-full whitespace-nowrap">
                <thead class="bg-black/60">
                    <th class="text-left py-3 px-2 rounded-l-lg">Image</th>
                    <th class="text-left py-3 px-2">Name</th>
                    <th class="text-left py-3 px-2">Created At</th>
                    <th class="text-left py-3 px-2">Updated At</th>
                    <th class="text-left py-3 px-2 rounded-r-lg">Actions</th>
                </thead>
                <tr v-for="brand in brands" :key="brand.id" class="border-b border-gray-700">
                    <td class="py-3 px-2 font-bold">
                        <div class="w-32">
                            <span><img class="object-fill h-32" :src="brand.image_url" alt=""></span>
                        </div>
                    </td>
                    <td class="py-3 px-2">{{ brand.name }}</td>
                    <td class="py-3 px-2">{{ brand.created_at }}</td>
                    <td class="py-3 px-2">{{ brand.updated_at }}</td>
                    <td class="py-3 px-2">
                        <div :class="isDelete(brand.id) ? 'hidden' : 'inline-flex items-center space-x-3'">
                            <a href="#" @click="changeEditBrandId(brand.id)" title="Edit" class="hover:text-white"><svg xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5 group-hover:text-indigo-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </a>
                            <a href="#" @click.prevent="changeDeleteBrandId(brand.id)" title="Delete" class="hover:text-white"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="w-5 h-5 group-hover:text-indigo-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </a>
                        </div>
                        <div :class="isDelete(brand.id) ? 'inline-flex items-center space-x-3' : 'hidden'">
                            <a href="#" @click.prevent="deleteBrand(brand.id)" title="Confirm" class="hover:text-white"><svg 
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
                    </td>
                </tr>
            </table>
        </div>
    </div>

</template>

<script>
export default {

    data() {
        return {
            brands: null,
            name: null,
            image: null,
            imagePreview: null,
            addForm: false,
            editForm: false,
            errors: '',
            deleteBrandId: null,
            editBrandId: null,
            successMessage: null,
            deleteMessage: null,
        }
    },

    mounted() {
        this.getBrands()
    },

    

    methods: {
        addBrandForm() {
            this.addForm = true
        },

        getBrands() {
            axios.get('api/brands')
                .then(res => {
                    this.brands = res.data
                })
        },

        cancelAddForm() {
            this.addForm = false
            this.name = ''
            this.image = ''
            this.imagePreview = ''
            this.errors = ''
        },



        onFileChange(event) {
            this.image = event.target.files[0]
            const reader = new FileReader()
            reader.readAsDataURL(this.image)
            reader.onload = event => {
                this.imagePreview = event.target.result
            }

        },

        store() {
            const data = new FormData
            data.append('name', this.name)
            data.append('image', this.image)
            axios.post('/api/brands', data)
                .then(res => {
                    this.name = ''
                    this.image = ''
                    this.imagePreview = ''
                    this.addForm = false
                    this.successMessage = res.data.success
                    setTimeout( () => this.successMessage = null, 2000)
                    this.getBrands()
                })
                .catch(err => {
                    this.errors = err.response.data.errors
                    if (this.errors.name) {
                        this.name = ''
                    } else if (this.errors.image) {
                        this.image = ''
                    } else if (this.errors.name && this.errors.image) {
                        this.name = ''
                        this.image = ''
                    }
                })
        },

        changeEditBrandId(id) {
            this.editBrandId = id
            this.editForm = true
        },

        isEdit(id) {
            return this.editBrandId === id
        },

        cancelEditForm() {
            this.editForm = false
            this.name = ''
            this.image = ''
            this.imagePreview = ''
            this.errors = ''
        },

        changeDeleteBrandId(id) {
            this.deleteBrandId = id
        },

        isDelete(id) {
            return this.deleteBrandId === id
        },

        deleteBrand(id) {

            axios.delete(`/api/brands/${id}`)
                .then(res => {
                    this.deleteMessage = res.data.deleted
                    setTimeout( () => this.deleteMessage = null, 2000)
                    this.getBrands()
                })
        },

        cancelDelete() {
            this.deleteBrandId = ''
        },
        
    },
}
</script>

<style>

.fade-enter-from {
    opacity: 0;
}
.fade-enter-to {
    opacity: 1;
}
.fade-enter-active {
    transition: all 2s ease;
}
.fade-leave-from {
    opacity: 1;
}
.fade-leave-to {
    opacity: 0;
}
.fade-leave-active {
    transition: all 2s ease;
}

</style>