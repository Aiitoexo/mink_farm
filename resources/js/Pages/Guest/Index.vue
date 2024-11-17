<template>
    <div class="relative w-3/5 mx-auto grid grid-cols-3 gap-6">
        <AnimalCard
            v-for="animal in animals"
            key="animal.id"
            :animal="animal"
            @showModal="photosModal = $event; activeModal = true"
            @contactModal="selectedAnimal = $event; contactModal = true"
        />

        <ImageModal
            v-if="activeModal"
            :photos="photosModal"
            @close="activeModal = false; photosModal = []"
        />

        <ContactModal
            v-if="contactModal"
            :animal="selectedAnimal"
            @close="contactModal = false"
        />
    </div>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import AnimalCard from "@/Components/AnimalCard.vue";
import ImageModal from "@/Components/ImageModal.vue";
import ContactModal from "@/Components/ContactModal.vue";
export default {
    name: "Index",
    components: {
        ImageModal,
        AnimalCard,
        ContactModal
    },
    layout: GuestLayout,
    props: {
        animals: Object
    },
    data() {
        return {
            activeModal: false,
            photosModal: [],
            contactModal: false,
            selectedAnimal: {}
        }
    },
    methods: {
    },
}
</script>
