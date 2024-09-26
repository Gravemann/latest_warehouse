<template >
    <div :class="this.$parent.editForm ? 'flex mb-6' : 'hidden'">
            <div class="flex-col">
                <form @submit.prevent="update(id)">
                    <p class="ml-1">Name</p>
                    <input v-model="name"
                        class="bg-black/60 font-semibold text-slate-200 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded"
                        type="text" name="name">
                    <div v-for="nameError in this.$parent.errors.name">
                        <div v-show="nameError" class="text-red-500 text-sm mb-1 ml-1">
                            {{ nameError }}
                        </div>
                    </div>
                    <div>
                        <input type="file" name="image" @change="onFileChange" ref="image" class="text-sm text-slate-200 mb-6 ml-1
                        file:mr-5 file:py-2 file:px-6
                        file:rounded file:border-0
                        file:text-sm file:font-semibold
                        file:bg-blue-50 border-slate-200 file:text-blue-700
                        hover:file:border-transparent hover:file:text-indigo-400
                        hover:file:bg-white/10 transition">
                    </div>
                    <div v-for="imageError in this.$parent.errors.image">
                        <div v-show="imageError" class="text-red-500 text-sm mb-1 ml-1">
                            {{ imageError }}
                        </div>
                    </div>
                    <div v-if="imagePreview" class="w-40 ml-1">
                        <img :src="imagePreview" class="object-fill h-40">
                    </div>
                    <div class="flex-col mt-3">
                        <div class="flex items-center space-x-10">
                            <button class="bg-transparent ml-1 text-slate-200 leading-4 font-semibold px-4 py-2 border
                            border-slate-200 hover:border-transparent rounded
                            hover:text-indigo-400 transition duration-150 hover:bg-white/10 ease-linear cursor-pointer">
                                Update
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
</template>

<script>
    export default {
        data() {
            return {
                name: null,
                image: null,
                imagePreview: null,
            }
        },

        methods: {
            changeUpdateBrandId(id, name, image) {
                this.$parent.editForm = true
                this.$parent.addForm = false
                this.editId = id
                this.name = name
                this.image = image
                this.imagePreview = image
            },

            cancelEditForm() {
                this.$parent.editForm = false
                this.$parent.editId = null
                this.name = null
                this.image = null
                this.$refs.image.value = null
                this.imagePreview = null
            },

            onFileChange(event) {
                this.image = event.target.files[0]
                const reader = new FileReader()
                reader.readAsDataURL(this.image)
                reader.onload = event => {
                    this.imagePreview = event.target.result
                }
            },

            update(id) {
                id = this.editId
                const data = new FormData
                data.append('name', this.name)
                data.append('image', this.image)
                data.append('_method', 'PATCH')
                axios.post(`/api/brands/${id}`, data, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.$parent.editId = ''
                    this.name = null
                    this.image = ''
                    this.imagePreview = ''
                    this.$parent.errors = ''
                    this.$parent.editForm = false
                    this.$parent.successMessage = res.data.success
                    this.$parent.failMessage = res.data.fail
                    this.$parent.$refs.toastlist.$refs.s.getMessage()
                    this.$parent.$refs.toastlist.$refs.d.getMessage()
                    setTimeout( () => this.$parent.successMessage = null, 2000)
                    setTimeout( () => this.$parent.failMessage = null, 2000)
                    this.$parent.getBrands()
                })
                .catch(err => {
                    this.$parent.errors = err.response.data.errors
                    if (this.$parent.errors.name) {
                        this.name = ''
                    } else if (this.$parent.errors.image) {
                        this.image = ''
                    }
                })
            },
        },
    }
</script>
