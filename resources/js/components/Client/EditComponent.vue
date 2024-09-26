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
                    <p class="ml-1">Surname</p>
                    <input v-model="surname"
                        class="bg-black/60 font-semibold text-slate-200 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded"
                        type="text" name="surname">
                    <div v-for="surnameError in this.$parent.errors.surname">
                        <div v-show="surnameError" class="text-red-500 text-sm mb-1 ml-1">
                            {{ surnameError }}
                        </div>
                    </div>
                    <p class="ml-1">Contact number</p>
                    <input v-model="contact_number"
                        class="bg-black/60 font-semibold text-slate-200 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded"
                        type="text" name="contact_number">
                    <div v-for="contactNumberError in this.$parent.errors.contact_number">
                        <div v-show="contactNumberError" class="text-red-500 text-sm mb-1 ml-1">
                            {{ contactNumberError }}
                        </div>
                    </div>
                    <p class="ml-1">Company</p>
                    <input v-model="company"
                        class="bg-black/60 font-semibold text-slate-200 mb-2 ml-1 focus:outline-none focus:border-transparent focus:ring ring-indigo-400 border rounded"
                        type="text" name="company">
                    <div v-for="companyError in this.$parent.errors.company">
                        <div v-show="companyError" class="text-red-500 text-sm mb-1 ml-1">
                            {{ companyError }}
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
                surname: null,
                contact_number: null,
                company: null,
                image: null,
                imagePreview: null,
            }
        },

        methods: {
            changeUpdateClientId(id, name, surname, contact_number, company, image) {
                this.$parent.editForm = true
                this.$parent.addForm = false
                this.editId = id
                this.name = name
                this.surname = surname
                this.contact_number = contact_number
                this.company = company
                this.image = image
                this.imagePreview = image
            },

            cancelEditForm() {
                this.$parent.editForm = false
                this.$parent.editId = ''
                this.name = null
                this.surname = null
                this.contact_number = null
                this.company = null
                this.image = ''
                this.imagePreview = ''
                this.$parent.errors = ''
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
                data.append('surname', this.surname)
                data.append('contact_number', this.contact_number)
                data.append('company', this.company)
                data.append('image', this.image)
                data.append('_method', 'PATCH')
                axios.post(`/api/clients/${id}`, data, {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('api_key')}`
                    }
                })
                .then(res => {
                    this.$parent.editId = ''
                    this.name = null
                    this.surname = null
                    this.contact_number = null
                    this.company = null
                    this.image = null
                    this.imagePreview = null
                    this.$parent.errors = ''
                    this.$parent.editForm = false
                    this.$parent.successMessage = res.data.success
                    this.$parent.failMessage = res.data.fail
                    this.$parent.$refs.toastlist.$refs.s.getMessage()
                    this.$parent.$refs.toastlist.$refs.d.getMessage()
                    setTimeout( () => this.$parent.successMessage = null, 2000)
                    setTimeout( () => this.$parent.failMessage = null, 2000)
                    this.$parent.getClients()
                })
                .catch(err => {
                    this.$parent.errors = err.response.data.errors
                    if (this.$parent.errors.name) {
                        this.name = null
                    } else if (this.$parent.errors.surname) {
                        this.surname = ''
                    } else if (this.$parent.errors.contact_number) {
                        this.contact_number = ''
                    } else if (this.$parent.errors.company) {
                        this.company = ''
                    } else if (this.$parent.errors.image) {
                        this.image = ''
                    }
                })
            },
        },
    }
</script>
