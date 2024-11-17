<template>
    <div class="w-full min-h-screen bg-autumn-50 relative space-y-6">
        <Header
            @modalLogin="activeModal"
            :auth="auth"
            :page="page"
        />

        <div v-if="auth && page === 'guest'" class="relative h-[500px] overflow-hidden">
            <img
                src="https://images.unsplash.com/photo-1500382017468-9049fed747ef?auto=format&fit=crop&q=80"
                alt="Bg Mink Farm"
                class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-b from-autumn-900/60 to-autumn-800/40" />
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="text-center text-autumn-50 px-4">
                    <h1 class="text-5xl font-bold mb-4">Bienvenue chez Mink Farm</h1>
                </div>
            </div>
        </div>

        <slot @auth="isAuth = $event ?? false"></slot>

        <AdminLoginModal
            v-if="modalLogin"
            @close="modalLogin = false"
        />
    </div>
</template>

<script>
import Header from "@/Components/Header.vue";
import AdminLoginModal from "@/Components/AdminLoginModal.vue";
export default {
    name: "GuestLayout",
    components: {
        Header,
        AdminLoginModal
    },
    props: {
        auth: {
            type: Boolean,
            required: false,
            default: false
        },
        page: {
            type: String,
            required: false,
            default: "guest"
        }
    },
    data() {
        return {
            modalLogin: false,
            isAuth: false
        };
    },
    methods: {
        activeModal(value) {
            this.modalLogin = value;
        },
    }
};
</script>
