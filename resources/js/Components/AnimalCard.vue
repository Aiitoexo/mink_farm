<template>
    <div class="col-span-6 md:col-span-3 xl:col-span-2 h-full bg-white rounded-xl shadow-lg overflow-hidden transition-transform hover:scale-[1.02] border border-autumn-100 flex flex-col">
        <div class="h-64 flex-shrink-0">
            <img
                :src="animal.photos[0].url"
                :alt="animal.name"
                class="w-full h-full object-cover cursor-zoom-in"
                @click="$emit('showModal', animal.photos)"
            />
        </div>

        <div class="p-6 flex flex-col flex-grow">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-semibold text-autumn-900">{{ animal.name }}</h3>
                    <p class="text-sm text-autumn-600">{{ animal.breed.name }}</p>
                </div>

                <span :class="[
                      'px-3 py-1 rounded-full text-sm font-medium',
                      animal.status === 'available'
                        ? 'bg-harvest-100 text-harvest-800'
                        : 'bg-autumn-100 text-autumn-800'
                    ]">
                      Disponible
                    </span>
            </div>

            <div class="grid grid-cols-2">
                <div class="col-span-1 lg:col-span-2 flex items-center gap-2 mb-3 text-autumn-600">
                    <Calendar class="w-4 h-4" />
                    <span class="text-sm flex items-center">{{ ageText }}</span>
                </div>

                <div class="col-span-1 lg:col-span-2 flex items-center lg:block gap-2 mb-3 text-autumn-600">
                    <p>{{ animal.type.name }}</p>
                    <p>{{ animal.breed.name }}</p>
                </div>
            </div>

            <div class="flex-grow">
                <p class="text-autumn-700 line-clamp-2">{{ animal.description }}</p>
            </div>

            <div class="grid grid-cols-2 pt-4 mt-auto gap-y-4">
                <span class="col-span-2 md:col-span-1 text-2xl font-bold text-autumn-800 flex items-center">
                    {{ animal.price }}€
                </span>

                <div class="col-span-2 md:col-span-1 flex justify-end">
                    <button
                        class="w-full md:w-auto flex items-center justify-center gap-2 px-4 py-2 bg-autumn-600 text-white rounded-lg hover:bg-autumn-700 transition-colors"
                        @click="$emit('contactModal', animal)"
                    >
                        <Mail class="w-4 h-4" />
                        Contacter
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { Calendar, Mail } from 'lucide-vue-next'
import ImageModal from "@/Components/ImageModal.vue";
export default {
    name: "AnimalCard",
    components: {
        Calendar,
        Mail,
        ImageModal
    },
    props: {
        animal: Object
    },
    data() {
        return {
            showImageModal: false
        }
    },
    computed: {
        ageText() {
            return `${this.animal.age} ${this.animal.age === 1 ? 'an' : 'ans'}`
        },
    }
}
</script>
