<template>
    <Layout
        :auth="auth"
        :page="page"
    >
        <div class="lg:w-4/5 xl:w-4/6 mx-auto overflow-hidden flex flex-col">
            <FilterBar
                :types="types"
                :animals="animals"
                @results="updateResult"
            />

            <table class="mt-6 divide-y divide-gray-200 bg-white shadow-md rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Animal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Prix
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <AdminRowItem
                        v-for="animal in allResults"
                        :key="animal.id"
                        :animal="animal"
                        @openForm="openForm"
                        @deleteAnimal="deleteAnimal"
                    />
                </tbody>
            </table>
        </div>

        <ModalFormAnimal
            v-if="openModalForm"
            :animal="selectedAnimal"
            :types="types"
            :breeds="breeds"
            @close="openModalForm = false"
            @animalsUpdated="this.allResults = $event"
        />

        <ModalDeleteAnimal
            v-if="openModalDelete"
            :animal="selectedAnimal"
            @close="openModalDelete = false"
            @animalsUpdated="this.allResults = $event"
        />
    </Layout>
</template>

<script>
import Layout from "@/Layouts/Layout.vue";
import { Trash2, Pencil } from "lucide-vue-next";
import FilterBar from "@/Components/FilterBar.vue";
import ModalFormAnimal from "@/Components/ModalFormAnimal.vue";
import ModalDeleteAnimal from "@/Components/ModalDeleteAnimal.vue";
import AdminRowItem from "@/Components/AdminRowItem.vue";
export default {
    name: "AdminIndex",
    components: {
        ModalDeleteAnimal,
        Layout,
        Trash2,
        Pencil,
        FilterBar,
        ModalFormAnimal,
        AdminRowItem,
    },
    props: {
        auth: {
            type: Boolean,
            required: true,
        },
        page: {
            type: String,
            required: true,
        },
        animals: {
            type: Object,
            required: true,
        },
        types: {
            type: Object,
            required: true,
        },
        breeds: {
            type: Object,
            required: true,
        }
    },
    data() {
        return {
            initialAnimals: this.animals,
            allResults: [...this.animals],
            openModalForm: false,
            openModalDelete: false,
            selectedAnimal: null,
        };
    },
    methods: {
        updateResult(results) {
            this.allResults = [...results];
        },
        openForm(animal) {
            this.openModalForm = true;
            this.selectedAnimal = animal;
        },
        deleteAnimal(animal) {
            this.openModalDelete = true;
            this.selectedAnimal = animal;
        }
    }
};
</script>
