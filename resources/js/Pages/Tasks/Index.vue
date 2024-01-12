<template>
    <AppLayout title="Dashboard">
        <div v-if="$page.props.flash.message" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">{{$page.props.flash.message }}</span>
        </div>

        <div class="mx-auto mx-10 my-5">
            <a :href="route('tasks.create')">
                <button
                    class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    New task
                </button>
            </a>

            <h1 class="mt-10 mb-3 text-xl">Tasks</h1>

            <ul role="list" class="grid grid-cols-1 gap-5 sm:grid-cols-2 sm:gap-6 lg:grid-cols-4">
                <li v-for="task in tasks" :key="task.title" class="col-span-1 flex rounded-md shadow-sm">
                    <div class="bg-green-500 flex w-16 flex-shrink-0 items-center justify-center rounded-l-md text-sm font-medium text-white">{{ task.user.name.slice(0, 2).toUpperCase() }}</div>
                    <div class="flex flex-1 items-center justify-between truncate rounded-r-md border-b border-r border-t border-gray-200 bg-white">
                        <div class="flex-1 truncate px-4 py-2 text-sm">
                            <Link :href="route('tasks.edit', task.id)">
                                {{ task.title }}
                            </Link>
                            <p class="text-gray-500"> {{ task.description }}</p>
                        </div>
                        <div class="flex-shrink-0 pr-2">
                            <button type="button" class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-transparent bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                <span class="sr-only">Open options</span>
                                <EllipsisVerticalIcon class="h-5 w-5" aria-hidden="true" />
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import {Link} from "@inertiajs/vue3";


export default {
    components: {Link, ApplicationMark, AppLayout},
    props: {
        message: String,
        tasks: Array,
    },
    computed: {
      message() {
          return this.$inertia.page.props.message
        }
    },
    methods: {
        create() {
            this.form.get('/tasks/create')
        },
    }
};
</script>
