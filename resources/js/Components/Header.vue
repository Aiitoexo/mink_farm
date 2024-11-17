<template>
    <header class="bg-autumn-800/95 text-autumn-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <button class="flex items-center gap-2">
                    <PawPrint class="w-8 h-8 text-harvest-300" />
                    <span class="text-xl font-bold">Mink Farm</span>
                </button>

                <nav class="flex items-center gap-6">
                    <button
                        v-if="!auth"
                        class="px-4 py-2 bg-autumn-600 text-autumn-50 rounded-lg hover:bg-autumn-700 transition-colors"
                        @click="$emit('modalLogin', true)"
                    >
                        Administration
                    </button>

                    <button
                        v-if="auth"
                        class="px-4 py-2 bg-autumn-600 text-autumn-50 rounded-lg hover:bg-autumn-700 transition-colors"
                        @click="logout"
                    >
                        Deconnexion
                    </button>

                    <button
                        v-if="auth"
                        class="px-4 py-2 bg-autumn-600 text-autumn-50 rounded-lg hover:bg-autumn-700 transition-colors"
                        @click="dashboard"
                    >
                        Administration
                    </button>
                </nav>
            </div>
        </div>
    </header>
</template>

<script>
import { PawPrint } from 'lucide-vue-next'
import { router } from '@inertiajs/vue3'

export default {
    name: 'Header',
    components: {
        PawPrint
    },
    props: {
        auth: {
            type: Boolean,
            required: false,
            default: false
        }
    },
    methods: {
        dashboard() {
            router.get('/admin')
        },
        logout() {
           router.post('/logout')
        }
    }
}
</script>
