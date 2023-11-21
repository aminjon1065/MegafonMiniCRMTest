<script setup>

import {defineProps} from "vue";
import {Link} from '@inertiajs/vue3'

const props = defineProps({
    next: {
        type: String,
    },
    previous: {
        type: String,
    },
    total: {
        type: Number,
    },
    perPage: {
        type: Number,
    },
    currentPage: {
        type: Number,
    },
    to: {
        type: Number,
    }
});

</script>

<template>
    <nav class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6"
         aria-label="Pagination">
        <div class="hidden sm:block">
            <p class="text-sm text-gray-700">
                Showing
                <span class="font-medium">{{ (currentPage - 1) * perPage + 1 }}</span>
                to
                <span class="font-medium">{{ Math.min(currentPage * perPage, total) }}</span>
                of
                <span class="font-medium">{{ total }}</span>
                results
            </p>

        </div>
        <div class="flex flex-1 justify-between sm:justify-end">
            <Link
                v-if="previous"
                :disabled="props.previous"
                :href="props.previous"
                class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">
                Previous
            </Link>
            <Link
                v-if="next"
                :href="props.next"
                class="relative ml-3 inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus-visible:outline-offset-0">Next</Link>
        </div>
    </nav>
</template>


<style scoped>

</style>
