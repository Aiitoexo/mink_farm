<template>
    <Layout
        :auth="auth"
        :page="page"
    >
        <div class="px-6 lg:px-0 lg:w-4/5 xl:w-4/6 mx-auto overflow-hidden flex flex-col">
            <div class="grid grid-cols-2 mb-6">
                <div class="col-span-2 md:col-span-1 flex justify-start flex-col">
                  <h1 class="text-3xl font-bold text-autumn-900 mt-6">Administration</h1>
                  <p class="text-gray-500 mt-2">
                      Gestion des animaux
                  </p>
                </div>

                <div class="col-span-2 md:col-span-1 flex md:justify-end">
                    <button
                        class="h-12 px-4 py-2 bg-autumn-600 text-autumn-50 rounded-lg hover:bg-autumn-700 transition-colors mt-6"
                        @click="openModalForm = true"
                    >
                        Ajouter un animal
                    </button>
                </div>
            </div>

            <FilterBar
                :types="types"
                :animals="animals"
                @results="updateResult"
                :auth="auth"
            />

            <table class="mt-6 divide-y divide-gray-200 bg-white shadow-md rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Animal
                        </th>
                        <th class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Prix
                        </th>
                        <th class="hidden md:block px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="hidden md:table-cell px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
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
            @animalsUpdated="updateResult"
        />

        <ModalDeleteAnimal
            v-if="openModalDelete"
            :animal="selectedAnimal"
            @close="openModalDelete = false"
            @animalsUpdated="updateResult"
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
