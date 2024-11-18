<template>
    <GuestLayout
        :auth="auth"
    >
        <div class="relative lg:w-4/5 xl:w-4/6 mx-auto grid grid-cols-6 gap-6 px-6 lg:px-0">
            <div class="col-span-6">
                <FilterBar
                    :types="types"
                    :animals="animals"
                    @results="updateResult"
                    :auth="auth"
                />
            </div>

            <AnimalCard
                v-for="animal in allResults"
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
    </GuestLayout>
</template>

<script>
import GuestLayout from '@/Layouts/Layout.vue'
import AnimalCard from "@/Components/AnimalCard.vue";
import ImageModal from "@/Components/ImageModal.vue";
import ContactModal from "@/Components/ContactModal.vue";
import FilterBar from "@/Components/FilterBar.vue";
export default {
    name: "GuestIndex",
    components: {
        GuestLayout,
        ImageModal,
        AnimalCard,
        ContactModal,
        FilterBar,
    },
    props: {
        animals: {
            type: Object,
            required: true
        },
        types: {
            type: Object,
            required: true
        },
        auth: {
            type: Boolean,
        }
    },
    data() {
        return {
            initialAnimals: this.animals,
            allResults: [...this.animals],
            activeModal: false,
            photosModal: [],
            contactModal: false,
            selectedAnimal: {},
        }
    },
    methods: {
        updateResult(results) {
            this.allResults = results;
        }
    }
}
</script>
