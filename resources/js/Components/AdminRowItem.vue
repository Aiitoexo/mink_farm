<template>
    <tr>
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
                    @click="this.$emit('openForm', animal)"
                    class="text-autumn-600 hover:text-autumn-900"
                >
                    <Pencil class="w-5 h-5" />
                </button>
                <button
                    @click="this.$emit('deleteAnimal', animal)"
                    class="text-red-600 hover:text-red-900"
                >
                    <Trash2 class="w-5 h-5" />
                </button>
            </div>
        </td>
    </tr>
</template>

<script>
import {Pencil, Trash2} from "lucide-vue-next";

export default {
    name: "AdminRowItem" ,
    components: {Trash2, Pencil},
    props: {
        animal: {
            type: Object,
            required: true
        }
    },
}
</script>

<style scoped>

</style>
