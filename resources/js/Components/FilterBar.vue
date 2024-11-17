<template>
    <div class="bg-white shadow-md rounded-lg p-4 border border-autumn-100">
        <div class="grid grid-cols-4 gap-4">
            <div class="relative col-span-4 xl:col-span-2 flex">
                <SearchIcon class="absolute left-3 top-1/2 transform -translate-y-1/2 text-autumn-400 w-5 h-5" />
                <input
                    type="text"
                    placeholder="Rechercher par nom ou race..."
                    class="w-full pl-10 pr-4 py-2 border border-autumn-200 rounded-lg focus:ring-2 focus:ring-autumn-500 focus:border-transparent"
                    @input="$emit('search', $event.target.value)"
                />
            </div>

            <select
                class="col-span-4 md:col-span-2 xl:col-span-1 px-4 py-2 border border-autumn-200 rounded-lg focus:ring-2 focus:ring-autumn-500 focus:border-transparent"
                @change="$emit('filter', $event.target.value)"
            >
                <option value="all">Tous les types</option>
                <option v-for="type in types" :value="type.id">{{ type.name }}</option>
            </select>

            <select
                class="col-span-4 md:col-span-2 xl:col-span-1 px-4 py-2 border border-autumn-200 rounded-lg focus:ring-2 focus:ring-autumn-500 focus:border-transparent"
                @change="$emit('sort', $event.target.value)"
            >
                <option value="price-asc">Prix : Croissant</option>
                <option value="price-desc">Prix : Décroissant</option>
                <option value="age-asc">Âge : Plus jeune</option>
                <option value="age-desc">Âge : Plus âgé</option>
            </select>
        </div>
    </div>
</template>

<script>
import { Search as SearchIcon  } from 'lucide-vue-next';
export default {
    name: "Search",
    components: {
        SearchIcon
    },
    props: {
        types: {
            type: Object,
            required: true
        }
    }
}
</script>

<style scoped>

</style>
