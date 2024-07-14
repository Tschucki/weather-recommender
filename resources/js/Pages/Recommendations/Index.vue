<script setup>
import RecommendationLayout from "@/Layouts/RecommendationLayout.vue";
import {TabsContent} from "@/Components/ui/tabs";
import {Head, Link} from "@inertiajs/vue3";

defineProps({
    place: {
        type: Object,
    },
    weathers: {
        type: Array,
    },
    averageTemperature: {
        type: String,
    },
    averageRain: {
        type: String,
    },
    averageTimeRain: {
        type: String,
    },
});

const tab = 'weather';

</script>

<template>
    <Head>
        <title>Wetter Vorhersage für {{ place.name }}</title>
    </Head>
    <RecommendationLayout :tab="tab" :place="place">
        <TabsContent :value="tab">
            <div class="grid grid-cols-3 gap-4">
                <h2 class="col-span-3 text-2xl font-semibold text-black dark:text-white">Durchschnitt die nächsten
                    Tage</h2>

                <div
                    class="flex items-center gap-4 min-h-28 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] border-accent-foreground transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div>
                        <h2 class="text-xl font-semibold text-black dark:text-white">Temperatur</h2>

                        <p class="text-sm/relaxed">
                            <span class="font-semibold">Durchschnitt: {{
                                    Number(averageTemperature).toFixed(2)
                                }}°C</span>
                        </p>
                    </div>
                </div>

                <div
                    class="flex items-center gap-4 min-h-28 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] border-accent-foreground transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div>
                        <h2 class="text-xl font-semibold text-black dark:text-white">Niederschlag</h2>

                        <p class="text-sm/relaxed">
                            <span class="font-semibold">Durchschnitt: {{ Number(averageRain).toFixed(2) }}mm</span>
                        </p>
                    </div>
                </div>

                <div
                    class="flex items-center gap-4 min-h-28 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] border-accent-foreground transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div>
                        <h2 class="text-xl font-semibold text-black dark:text-white">Regenzeit</h2>

                        <p class="text-sm/relaxed">
                            <span class="font-semibold">Durchschnitt: {{ Number(averageTimeRain).toFixed(2) }}h</span>
                        </p>
                    </div>
                </div>

                <h2 class="col-span-3 text-2xl font-semibold text-black dark:text-white">Vorhersage</h2>

                <div v-for="weather in weathers" :key="weather.id"
                     class="flex items-center gap-4 min-h-28 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] border-accent-foreground transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                >
                    <div>
                        <h2 class="text-xl font-semibold text-black dark:text-white">{{ weather.date }}</h2>

                        <p class="text-sm/relaxed">
                            <span class="font-semibold">{{weather.weather_description}}</span><br>
                            Temperatur: <span class="font-semibold">{{
                                weather.temperature_min
                            }}°C bis {{ weather.temperature_max }}°C</span>
                            <br>
                            Niederschlag: {{ weather.rain_sum }}mm
                            <br>
                            Max UV Index: {{ weather.uv_index_max }}
                        </p>
                    </div>
                </div>
            </div>
        </TabsContent>
    </RecommendationLayout>
</template>

<style scoped>

</style>
