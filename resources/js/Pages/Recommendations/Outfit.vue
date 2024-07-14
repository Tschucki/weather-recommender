<script setup>
import RecommendationLayout from "@/Layouts/RecommendationLayout.vue";
import {Button} from "@/Components/ui/button";
import {Head} from "@inertiajs/vue3";

defineProps({
    place: {
        type: Object,
    },
    outfit: {
        type: Array,
    },
});

const tab = 'outfit';
</script>

<template>
    <Head>
        <title>Outfit Empfehlungen für {{ place.name }}</title>
    </Head>
    <RecommendationLayout :tab="tab" :place="place">
        <div class="flex gap-4 flex-col mt-4">
            <a target="_blank" :href="item.url" v-for="(item, idx) in outfit['male']" :key="idx" class="cursor-pointer text-center">
                <div
                     class="flex items-center justify-center gap-4 min-h-28 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] border-accent-foreground transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div class="text-center flex flex-col items-center gap-4">
                        <h2 class="text-xl font-semibold text-black dark:text-white">{{ item.title }}</h2>
                        <img :src="item.image" :alt="item.title" class="aspect-square size-52 object-contain">
                        <a target="_blank" :href="item.url"><Button>Auf Amazon ansehen (Ohne Tracking)</Button></a>
                    </div>
                </div>
            </a>
        </div>
    </RecommendationLayout>
</template>

<style scoped>

</style>
