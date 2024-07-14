<script setup lang="ts">

import {Head} from "@inertiajs/vue3";
import {InformationCircleIcon, HandThumbUpIcon, MapPinIcon} from "@heroicons/vue/24/outline/index.js";
</script>

<template>
    <Head>
        <title>Empfehlungen basierend auf Wetterdaten</title>
    </Head>
    <div class="max-w-7xl mx-auto">
    <h2 class="text-3xl font-semibold">Empfehlungen basierend auf Wetterdaten</h2>

    <p class="mt-2">
        Hier findest du Empfehlungen basierend auf den Wetterdaten für die nächsten Tage.
    </p>
    <div class="grid grid-cols-2 gap-4 mt-4">
        <div
            class="flex items-center gap-4 min-h-28 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] border-accent-foreground transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >
            <div class="flex items-center gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-black dark:text-white">1. Suche nach einem Ort</h2>

                    <p class="text-sm/relaxed">
                        <span class="font-medium">Nutze die Suche oben und suche nach deinem Standort. Wähle anschließend den Ort aus erhalte Informationen zum Wetter und Vorschläge basierend auf der Vorhersage.</span>
                    </p>
                </div>
            </div>
        </div>
        <div
            class="flex items-center gap-4 min-h-28 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] border-accent-foreground transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >
            <div class="flex items-center gap-4">
                <InformationCircleIcon class="h-24 aspect-square text-foreground"></InformationCircleIcon>
                <div>
                    <h2 class="text-xl font-semibold text-black dark:text-white">Allgemeine Wetterinformationen</h2>

                    <p class="text-sm/relaxed">
                        <span class="font-medium">Erhalte eine Übersicht über die durchschnittliche Temperatur, Niederschlag und Regenzeit für die nächsten Tage.</span>
                    </p>
                </div>
            </div>
        </div>
        <div
            class="flex items-center gap-4 min-h-28 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] border-accent-foreground transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >
            <div class="flex items-center gap-4">
                <HandThumbUpIcon class="h-24 aspect-square text-foreground"></HandThumbUpIcon>
                <div>
                    <h2 class="text-xl font-semibold text-black dark:text-white">Outfitvorschläge</h2>

                    <p class="text-sm/relaxed">
                        <span
                            class="font-medium">Erhalte Empfehlungen für Kleidung basierend auf der Wettervorhersage.</span>
                    </p>
                </div>
            </div>
        </div>
        <div
            class="flex items-center gap-4 min-h-28 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] border-accent-foreground transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
        >
            <div class="flex items-center gap-4">
                <MapPinIcon class="h-24 aspect-square text-foreground"></MapPinIcon>
                <div>
                    <h2 class="text-xl font-semibold text-black dark:text-white">Aktivitätsvorschläge</h2>

                    <p class="text-sm/relaxed">
                        <span
                            class="font-medium">Erhalte Empfehlungen für Aktivitäten basierend auf der Wettervorhersage. Was ist bei diesem Wetter am besten geeignet.</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<style scoped>

</style>
