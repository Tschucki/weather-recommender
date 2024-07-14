<script setup>
import {ref, watch} from 'vue';
import {Head, Link, router} from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import {Button} from '@/Components/ui/button'
import {Input} from "@/Components/ui/input";
import {Icon} from "@iconify/vue";

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false);

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};

const searchTerm = ref('');
const searchResults = ref([]);

watch(searchTerm, (value) => {
    if (value.length > 2) {
        axios.get(route('places.search', {searchTerm: value}))
            .then((response) => {
                searchResults.value = response.data;
            });
    }
    if (value.length === 0) {
        searchResults.value = [];
    }
});
</script>

<template>
    <div>
        <Head :title="title"/>

        <Banner/>
        <div class=" p-4 shadow-xl flex flex-col" v-auto-animate>
            <div class="flex items-center gap-4 sm:flex-row flex-col">
                <Link :href="route('home')">
                    <h1 class="font-semibold tracking-wide text-xl">Wetter Empfehlungen</h1>
                </Link>
                <div class="relative w-full flex-1 items-center">
                    <Input id="search" type="text" placeholder="Search..." class="pr-10" v-model="searchTerm"/>
                    <!--                <span class="absolute end-0 inset-y-0 flex items-center justify-center">
                          <Button variant="outline" class="border-l-0 rounded-r" type="button" @click="askForLocation">
                                    <MapPinIcon
                                        class="h-[1.2rem] w-[1.2rem] text-foreground"
                                    />
                                </Button>
                        </span>-->
                </div>
                <div class="flex items-center gap-4">
                    <a target="_blank" href="https://github.com/Tschucki/weather-recommender">
                        <Button variant="outline">
                            <Icon
                                icon="radix-icons:github-logo"
                                class="h-[1.2rem] w-[1.2rem] text-foreground"
                            />
                        </Button>
                    </a>
                </div>
            </div>
            <div class="mt-4" v-if="Object.keys(searchResults).length > 0" v-auto-animate>
                <h2 class="font-semibold tracking-wide text-xl">Suchergebnisse</h2>
                <div v-for="(result, idx) in searchResults" :key="idx" class="grid grid-cols-1 gap-4 mt-4">
                    <Link
                        @click="searchResults = []"
                        :href="route('recommendations.index', {
                            place: result.slug
                        })"
                        class="flex items-center gap-4 rounded-lg bg-white p-2 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] transition duration-300 hover:text-black/70 hover:ring-black/20 focus:outline-none focus-visible:ring-[#FF2D20] dark:bg-zinc-900 dark:ring-zinc-800 dark:hover:text-white/70 dark:hover:ring-zinc-700 dark:focus-visible:ring-[#FF2D20]"
                    >
                        <span
                            class="size-8 sm:size-12 text-center flex self-center items-center justify-center text-2xl">{{
                                result.flag
                            }}</span>

                        <div>
                            <h2 class="text-xl font-semibold text-black dark:text-white">{{ result.name }}</h2>

                            <p class="text-sm/relaxed">
                                Land: <span class="font-semibold">{{ result.country }}</span>
                                <br>
                                Längengrad: {{ result.longitude }}
                                <br>
                                Breitengrad: {{ result.latitude }}
                            </p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
        <div class="p-4" v-auto-animate>
            <slot/>
        </div>

    </div>
</template>
