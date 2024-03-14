<template>
    <AppLayout title="Dashboard">
        <div v-if="$page.props.flash.message" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{$page.props.flash.message }}</span>
        </div>

        <div class="mx-10 my-5">
            <a :href="route('tasks.create')">
                <button
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    New task
                </button>
            </a>

            <h1 class="mt-10 mb-3 text-xl">Tasks</h1>

            <ul role="list" class="grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
                <li v-for="task in tasks.data" :key="task.title" class="col-span-1 flex rounded-md shadow-sm">
                    <div class="bg-green-500 flex w-16 flex-shrink-0 items-center justify-center rounded-l-md text-sm font-medium text-white">
                        {{ task.user.name.slice(0, 2).toUpperCase() }}
                    </div>
                    <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                        <div class="flex-1 truncate px-4 py-2 text-sm">
                            <Link :href="route('tasks.edit', task.id)">
                                {{ task.title }}
                            </Link>
                            <p class="text-gray-500"> {{ task.description }}</p>
                        </div>
                    </div>
                </li>
            </ul>

            <!-- Pagination -->
            <div class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 mt-5">
                <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing
                            <span class="font-medium">{{ tasks.from }}</span>
                            to
                            <span class="font-medium">{{ tasks.to }}</span>
                            of
                            <span class="font-medium">{{ tasks.total }}</span>
                            results
                        </p>
                    </div>
                    <div>
                        <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                            <a v-if="tasks.prev_page_url"
                               @click.prevent="changePage(tasks.prev_page_url)"
                               href="#"
                               class="relative inline-flex items-center rounded-l-md px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <ChevronLeftIcon class="h-5 w-5" aria-hidden="true" />
                            </a>
                            <a v-for="page in tasks.links"
                               :key="page.label"
                               @click.prevent="changePage(page.url)"
                               href="#"
                               class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                               :class="{ 'bg-indigo-600 text-white': tasks.current_page === page.label }">
                                {{ formatLabel(page.label) }}
                            </a>
                            <a v-if="tasks.prev_page_url"
                               @click.prevent="changePage(tasks.prev_page_url)"
                               href="#" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                <ChevronRightIcon class="h-5 w-5" aria-hidden="true" />
                            </a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import {Link} from "@inertiajs/vue3";
import { ChevronLeftIcon, ChevronRightIcon } from "@heroicons/vue/24/solid";


export default {
    components: {Link, ApplicationMark, AppLayout, ChevronLeftIcon, ChevronRightIcon},
    props: {
        tasks: Object,
    },
    computed: {
      message() {
          return this.$inertia.page.props.message
        }
    },
    methods: {
        formatLabel(label) {
            if (label === '&laquo; Previous') return 'Previous';
            if (label === 'Next &raquo;') return 'Next';

            return label;
        },
        changePage(url) {
            if (url) {
                this.$inertia.visit(url);
            }
        },
        create() {
            this.form.get('/tasks/create')
        },
    }
};
</script>
