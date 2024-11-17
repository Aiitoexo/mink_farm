<template>
    <div class="relative lg:w-4/5 xl:w-4/6 mx-auto grid grid-cols-6 gap-6 px-6 lg:px-0">
        <div class="col-span-6">
            <FilterBar
                :types="types"
                @search="updateSearch"
                @filter="updateFilter"
                @sort="updateSort"
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
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import AnimalCard from "@/Components/AnimalCard.vue";
import ImageModal from "@/Components/ImageModal.vue";
import ContactModal from "@/Components/ContactModal.vue";
import FilterBar from "@/Components/FilterBar.vue";
export default {
    name: "Index",
    components: {
        ImageModal,
        AnimalCard,
        ContactModal,
        FilterBar
    },
    layout: GuestLayout,
    props: {
        animals: {
            type: Object,
            required: true
        },
        types: {
            type: Object,
            required: true
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
            searchQuery: '',
            selectedFilter: 'all',
            selectedSort: ''
        }
    },
    watch: {
        searchQuery() {
            this.applyFilters();
        },
        selectedFilter() {
            this.applyFilters();
        },
        selectedSort() {
            this.applyFilters();
        }
    },
    methods: {
        updateSearch(value) {
            this.searchQuery = value;
        },
        updateFilter(value) {
            this.selectedFilter = value;
        },
        updateSort(value) {
            this.selectedSort = value;
        },
        applyFilters() {
            let results = [...this.initialAnimals];

            // Filter by search query
            if (this.searchQuery && this.searchQuery.length >= 2) {
                results = results.filter(animal => {
                    return (
                        animal.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                        animal.breed.name.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                });
            }

            // Filter by type
            if (this.selectedFilter !== 'all') {
                results = results.filter(animal => animal.type.id == this.selectedFilter);
            }

            // Filter by sort
            if (this.selectedSort === 'price-asc') {
                results.sort((a, b) => a.price - b.price);
            } else if (this.selectedSort === 'price-desc') {
                results.sort((a, b) => b.price - a.price);
            } else if (this.selectedSort === 'age-asc') {
                results.sort((a, b) => a.age - b.age);
            } else if (this.selectedSort === 'age-desc') {
                results.sort((a, b) => b.age - a.age);
            }

            this.allResults = results;
        }
    }
}
</script>
