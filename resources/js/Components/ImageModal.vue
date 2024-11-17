<template>
    <div
        class="fixed inset-0 bg-black/80 z-50 flex items-center justify-center p-4 cursor-zoom-out"
        @click="$emit('close')"
    >
        <button
            @click="$emit('close')"
            class="absolute top-4 right-4 text-white hover:text-autumn-200 transition-colors"
        >
            <X class="w-8 h-8" />
        </button>

        <div
            class="relative max-w-5xl max-h-[90vh] rounded-lg overflow-hidden"
            @click.stop
        >
            <img
                :src="photos[currentPhotoIndex].url"
                alt="Zoomed view"
                class="w-full h-full object-contain"
            />
        </div>
    </div>
</template>

<script>
import { X } from 'lucide-vue-next'

export default {
    name: 'ImageModal',
    components: {
        X
    },
    props: {
        photos: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            currentPhotoIndex: 0
        }
    },
    emits: ['close']
}
</script>
