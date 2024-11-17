<template>
    <div class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg max-w-md w-full p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-autumn-900">Contact pour {{ animal.name }}</h3>
                <button @click="$emit('close')" class="text-autumn-500 hover:text-autumn-700">
                    <X class="w-6 h-6" />
                </button>
            </div>

            <div class="space-y-6">
                <div class="flex items-center gap-4 p-4 bg-autumn-50 rounded-lg">
                    <img :src="animal.photos[0].url" :alt="animal.name" class="w-16 h-16 rounded-lg object-cover" />
                    <div>
                        <h4 class="font-semibold text-autumn-900">{{ animal.name }}</h4>
                        <p class="text-autumn-600">{{ animal.breed.name }}</p>
                        <p class="text-autumn-800 font-medium">{{ formattedPrice }}€</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <a
                        :href="`tel:+33123456789`"
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-autumn-600 text-white rounded-lg hover:bg-autumn-700 transition-colors"
                    >
                        <Phone class="w-5 h-5" />
                        Appeler maintenant
                    </a>

                    <a
                        :href="`mailto:mink@farm.com?subject=Intérêt pour ${animal.name}&body=Je suis intéressé(e) par ${animal.name} (${animal.breed})`"
                        class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-autumn-100 text-autumn-800 rounded-lg hover:bg-autumn-200 transition-colors"
                    >
                        <Mail class="w-5 h-5" />
                        Envoyer un email
                    </a>
                </div>

                <div class="text-sm text-autumn-600 text-center">
                    <p>Disponible du lundi au vendredi, de 9h à 18h</p>
                    <p>Contact d'urgence disponible 24h/24, 7j/7</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { X, Phone, Mail } from 'lucide-vue-next'

export default {
    name: 'ContactModal',
    components: {
        X,
        Phone,
        Mail
    },
    props: {
        animal: {
            type: Object,
            required: true
        }
    },
    computed: {
        formattedPrice() {
            return new Intl.NumberFormat('fr-FR').format(this.animal.price)
        }
    },
    emits: ['close']
}
</script>
