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
                <tr v-for="animal in allResults" :key="animal.id">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 flex-shrink-0">
                                <img
                                    class="h-10 w-10 rounded-full object-cover"
                                    :src="animal.photos[0].url"
                                    alt=""
                                />
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ animal.name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ animal.breed.name }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ animal.type.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">
                            {{ animal.price }}€
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
            <span
                :class="[
                'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                animal.status === 'available'
                  ? 'bg-green-100 text-green-800'
                  : 'bg-gray-100 text-gray-800'
              ]"
            >
              {{ animal.status === 'available' ? 'Disponible' : 'Vendu' }}
            </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex gap-2">
                            <button
                                @click="openForm(animal)"
                                class="text-autumn-600 hover:text-autumn-900"
                            >
                                <Pencil class="w-5 h-5" />
                            </button>
                            <button
                                @click="handleDelete(animal.id)"
                                class="text-red-600 hover:text-red-900"
                            >
                                <Trash2 class="w-5 h-5" />
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </Layout>
</template>

<script>
import Layout from "@/Layouts/Layout.vue";
import { Trash2, Pencil } from "lucide-vue-next";
import FilterBar from "@/Components/FilterBar.vue";
export default {
    name: "AdminIndex",
    components: {
        Layout,
        Trash2,
        Pencil,
        FilterBar,
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
    },
    data() {
        return {
            initialAnimals: this.animals,
            allResults: [...this.animals],
        };
    },
    methods: {
        updateResult(results) {
            this.allResults = results;
        },
        // openForm(animal) {
        //     this.$inertia.visit(`/admin/${animal.id}/edit`);
        // },
        // async handleDelete(id) {
        //     if (confirm("Êtes-vous sûr de vouloir supprimer cet animal ?")) {
        //         await this.$inertia.delete(`/admin/${id}`);
        //     }
        // },
    },
}
</script>

<style scoped>

</style>
