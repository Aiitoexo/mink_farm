<template>
    <div class="fixed inset-0 -top-6 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">
                    {{ animal ? 'Modifier l\'animal' : 'Ajouter un animal' }}
                </h3>
                <button
                    @click="$emit('close')"
                    class="text-gray-400 hover:text-gray-500"
                >
                    <X class="w-6 h-6" />
                </button>
            </div>

            <form @submit.prevent="submit" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Nom
                        </label>
                        <input
                            type="text"
                            v-model="formData.name"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-autumn-500 focus:ring-autumn-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Type
                        </label>
                        <select
                            v-model="formData.type"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-autumn-500 focus:ring-autumn-500"
                        >
                            <option v-for="type in types" :value="type.id">{{ type.name }}</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Race
                        </label>
                        <select
                            v-model="formData.breed"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-autumn-500 focus:ring-autumn-500"
                        >
                            <option v-for="breed in selectedBreed" :value="breed.id">{{ breed.name }}</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Âge
                        </label>
                        <input
                            type="number"
                            v-model.number="formData.age"
                            required
                            min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-autumn-500 focus:ring-autumn-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Prix
                        </label>
                        <input
                            type="number"
                            v-model.number="formData.price"
                            required
                            min="0"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-autumn-500 focus:ring-autumn-500"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">
                            Statut
                        </label>
                        <select
                            v-model="formData.status"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-autumn-500 focus:ring-autumn-500"
                        >
                            <option value="available">Disponible</option>
                            <option value="sold">Vendu</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Photos
                    </label>
                    <div class="flex">
                        <div
                            v-for="(photo, index) in formData.photos"
                            :key="index"
                            class="relative group"
                        >
                            <div
                                class="w-24 h-24 rounded-lg overflow-hidden border border-gray-200 cursor-pointer hover:border-autumn-500 transition-colors"
                                @click="openImagePreview(index)"
                            >
                                <img
                                    :src="photo.url"
                                    class="w-full h-full object-cover"
                                    alt="Aperçu"
                                />
                            </div>
                        </div>

                        <div
                            v-if="formData.photos.length < 5"
                            class="w-24 h-24 relative border-2 border-dashed border-gray-300 rounded-lg flex items-center justify-center hover:border-autumn-500 transition-colors"
                        >
                            <input
                                type="file"
                                accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                @change="handleImageUpload"
                                :disabled="formData.photos.length >= 5"
                            />
                            <div class="text-center">
                                <Plus class="w-6 h-6 mx-auto text-gray-400" />
                                <span class="text-xs text-gray-500">Ajouter</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">
                        Description
                    </label>
                    <textarea
                        v-model="formData.description"
                        required
                        rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-autumn-500 focus:ring-autumn-500"
                    ></textarea>
                </div>

                <div class="flex justify-end gap-4">
                    <button
                        type="button"
                        @click="$emit('close')"
                        class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-autumn-500"
                    >
                        Annuler
                    </button>
                    <button
                        type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-autumn-600 hover:bg-autumn-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-autumn-500"
                    >
                        {{ animal ? 'Mettre à jour' : 'Créer' }}
                    </button>
                </div>
            </form>
        </div>

        <div v-if="previewIndex !== null" class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center">
            <div class="relative max-w-4xl w-full mx-4">
                <img
                    :src="formData.photos[previewIndex].url"
                    class="w-full h-auto max-h-[80vh] object-contain rounded-lg"
                    alt="Prévisualisation"
                />

                <div class="absolute top-4 right-4 flex gap-2">
                    <button
                        @click="removeImage(previewIndex)"
                        class="p-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors"
                        title="Supprimer l'image"
                    >
                        <Trash2 class="w-5 h-5" />
                    </button>
                    <button
                        @click="previewIndex = null"
                        class="p-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition-colors"
                        title="Fermer"
                    >
                        <X class="w-5 h-5" />
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { X, Plus, Trash2 } from 'lucide-vue-next'
import {router} from "@inertiajs/vue3";

export default {
    name: 'ModalFormAnimal',
    components: {
        X,
        Plus,
        Trash2
    },
    props: {
        animal: {
            type: Object,
            default: null
        },
        types: {
            type: Object,
            required: true
        },
        breeds: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            formData: this.animal
                ? {
                    ...this.animal,
                    type: this.animal.type.id,
                }
                : {
                    id: null,
                    name: '',
                    type: 1,
                    breed: '',
                    age: 0,
                    description: '',
                    price: 0,
                    photos: [],
                    status: 'available'
                },
            allBreeds: this.breeds,
            previewIndex: null
        }
    },
    computed: {
        selectedBreed() {
            return this.allBreeds.filter(breed => breed.animal_type_id == this.formData.type)
        }
    },
    methods: {
        handleImageUpload(event) {
            const file = event.target.files[0]
            if (!file) return

            if (this.formData.photos.length >= 5) {
                return
            }

            const reader = new FileReader()
            reader.onload = (e) => {
                this.formData.photos.push({
                    url: e.target.result,
                    file
                })
            }
            reader.readAsDataURL(file)
            event.target.value = ''
        },
        removeImage(index) {
            this.formData.photos.splice(index, 1)
            this.previewIndex = null
        },
        openImagePreview(index) {
            this.previewIndex = index
        },
        submit() {
            router.patch(`/admin/update/${this.formData.id}`, this.formData, {
                onSuccess: (response) => {
                    this.$emit('close')
                    this.$emit('animalsUpdated', response.props.animals)
                }
            })
        }
    }
}
</script>
