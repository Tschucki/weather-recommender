<script setup>
import RecommendationLayout from "@/Layouts/RecommendationLayout.vue";
import {TabsContent} from "@/Components/ui/tabs";
import {Head, Link} from "@inertiajs/vue3";
import {StarIcon} from "@heroicons/vue/24/outline/index.js";

defineProps({
    place: {
        type: Object,
    },
    places: {
        type: Object,
    },
});

const tab = 'places';

</script>

<template>
    <Head>
        <title>Aktivitäten für {{ place.name }}</title>
    </Head>
    <RecommendationLayout :tab="tab" :place="place">
        <TabsContent :value="tab">
            <h2 class="col-span-3 text-2xl font-semibold text-black dark:text-white">Aktivitäten basierend auf
                Wetter</h2>
            <div class="space-y-4 mt-4">
                <div v-for="(item, idx) in places" v-if="places.length > 0" :key="idx"
                     class="flex items-center gap-4 min-h-28 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] border-accent-foreground transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div>
                        <h2 class="text-xl font-semibold text-black dark:text-white">{{ item.name }}</h2>

                        <p class="text-sm/relaxed" v-if="item.rating">
                            <span class="font-semibold flex items-center gap-1">{{ item.rating }} / 5 <StarIcon class="size-5 text-yellow-600"></StarIcon></span>
                        </p>
                    </div>
                </div>
                <h2 v-else class="text-xl font-semibold text-black dark:text-white">Nichts cooles gefunden</h2>
            </div>
        </TabsContent>
    </RecommendationLayout>
</template>

<style scoped>

</style>
