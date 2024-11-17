<template>
    <div class="fixed top-0 left-0 bg-black/60 h-screen w-screen overflow-hidden z-50 flex justify-center items-center">
        <form @submit.prevent="submit" class="bg-white rounded-xl border border-autumn-500 p-6 space-y-4">
            <div>
                <div class="relative col-span-4 xl:col-span-2 flex">
                    <Mail class="absolute left-3 top-1/2 transform -translate-y-1/2 text-autumn-400 w-5 h-5" />
                    <input
                        type="text"
                        placeholder="E-mail"
                        v-model="form.email"
                        class="w-72 pl-10 pr-4 py-2 border border-autumn-200 rounded-lg focus:ring-2 focus:ring-autumn-500 focus:border-transparent"
                    />
                </div>
            </div>

            <div>
                <div class="relative col-span-4 xl:col-span-2 flex">
                    <KeyRound class="absolute left-3 top-1/2 transform -translate-y-1/2 text-autumn-400 w-5 h-5" />
                    <input
                        type="password"
                        placeholder="Mot de passe"
                        v-model="form.password"
                        class="w-72 pl-10 pr-4 py-2 border border-autumn-200 rounded-lg focus:ring-2 focus:ring-autumn-500 focus:border-transparent"
                    />
                </div>
            </div>

            <div class="flex space-x-4">
                <button
                    class="flex-1 px-6 py-2 rounded-lg bg-white border border-autumn-500 text-autumn-500 transition-colors"
                    type="button"
                    @click="$emit('close')"
                >
                    Annuler
                </button>

                <button
                    class="flex-1 px-6 py-2 rounded-lg bg-autumn-500 text-white hover:bg-autumn-700 transition-colors"
                    type="submit"
                >
                    Connexion
                </button>
            </div>
        </form>


    </div>
</template>

<script>
import {Mail, KeyRound, X} from 'lucide-vue-next';
import { router } from '@inertiajs/vue3'
export default {
    name: "AdminLoginModal",
    components: {
        X,
        Mail,
        KeyRound
    },
    data() {
        return {
            form: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        submit() {
            router.post('/login', this.form);
        }
    }
}
</script>
