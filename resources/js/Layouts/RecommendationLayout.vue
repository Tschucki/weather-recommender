<script setup>
import {Tabs, TabsContent, TabsList, TabsTrigger} from '@/Components/ui/tabs'
import {Link} from '@inertiajs/vue3';

defineProps({
    place: Object,
    tab: String,
});

</script>

<template>
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl/relaxed font-semibold pb-4">{{ place.flag }} {{ place.name }}</h1>
        <Tabs :default-value="tab">
            <TabsList class="w-full flex">
                <Link class="flex-1" :href="route('recommendations.index', {
                    place: place.slug,
                })">
                    <TabsTrigger value="weather" class="w-full">
                        Wetter Allgemein
                    </TabsTrigger>
                </Link>
                <Link class="flex-1" :href="route('recommendations.outfit', {
                    place: place.slug,
                })">
                    <TabsTrigger value="outfit" class="w-full">
                        Outfit
                    </TabsTrigger>
                </Link>
                <Link class="flex-1" :href="route('recommendations.places', {
                    place: place.slug,
                })">
                    <TabsTrigger value="places" class="w-full">
                        Freizeitaktivitäten
                    </TabsTrigger>
                </Link>
                <TabsTrigger value="rezepte" class="flex-1">
                    Rezepte (TODO)
                </TabsTrigger>
            </TabsList>
            <slot/>
        </Tabs>
    </div>
</template>

<style scoped>

</style>
