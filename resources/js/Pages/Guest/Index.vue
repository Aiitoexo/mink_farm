<template>
    <div>
        <h1>Guest Layout</h1>
        <slot></slot>
    </div>
</template>

<script>
import GuestLayout from '@/Layouts/GuestLayout.vue'
export default {
    name: "Index",
    layout: GuestLayout
}
</script>

<style scoped>

</style>
