<template>
    <div class="fixed inset-0 -top-6 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-full max-w-2xl shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-900">
                    Suppression de l'animal {{ animal.name }}
                </h3>
                <button
                    @click="$emit('close')"
                    class="text-gray-400 hover:text-gray-500"
                >
                    <X class="w-6 h-6" />
                </button>
            </div>

            <p class="text-gray-700">
                Êtes-vous sûr de vouloir supprimer l'animal {{ animal.name }} ?
            </p>

            <div class="flex justify-end mt-4">
                <button
                    @click="$emit('close')"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors"
                >
                    Annuler
                </button>
                <button
                    @click="deleteAnimal"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors ml-2"
                >
                    Supprimer
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import {X} from "lucide-vue-next";
import {router} from "@inertiajs/vue3";

export default {
    name: "ModalDeleteAnimal" ,
    components: {X},
    props: {
        animal: {
            type: Object,
            required: false,
            default: null
        }
    },
    methods: {
        deleteAnimal() {
            router.delete(`/admin/delete/${this.animal.id}`, {
                onSuccess: (response) => {
                    this.$emit('close')
                    this.$emit('animalsUpdated', response.props.animals)
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
