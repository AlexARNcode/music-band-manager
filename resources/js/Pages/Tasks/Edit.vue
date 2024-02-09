<template>
    <AppLayout title="Dashboard">
        <div class="mx-auto mx-10 my-5">
            <a :href="route('tasks')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                    <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-4.28 9.22a.75.75 0 0 0 0 1.06l3 3a.75.75 0 1 0 1.06-1.06l-1.72-1.72h5.69a.75.75 0 0 0 0-1.5h-5.69l1.72-1.72a.75.75 0 0 0-1.06-1.06l-3 3Z" clip-rule="evenodd" />
                </svg>
            </a>

            <form @submit.prevent="update" class="mt-5">
                <div>
                    <label for="name" class="block text-gray-900">Title</label>
                    <div v-if="form.errors.title" class="text-red-500 text-sm">
                        {{ form.errors.title }}
                    </div>
                    <text-input
                        v-model="form.title"
                        class="border-0 w-full"
                        placeholder="Title">
                    </text-input>
                </div>

                <div class="mt-5">
                    <label for="comment" class="block text-gray-900">Description</label>
                    <div v-if="form.errors.description" class="text-red-500 text-sm">
                        {{ form.errors.description }}
                    </div>
                    <div class="mt-2">
                    <textarea
                        v-model="form.description"
                        rows="4"
                        name="description"
                        id="description"
                        class="w-full border-0 text-gray-900"
                        placeholder="Description"/>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <button
                        @click="cancel"
                        type="button"
                        class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
                    <button
                        @click.prevent="destroy"
                        type="submit"
                        class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">Delete
                    </button>
                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import TextInput from "@/Components/TextInput.vue";

export default {
    components: {TextInput, AppLayout},
    data() {
        return {
            form: this.$inertia.form({
                title: this.task.title,
                description: this.task.description,
            }),
        }
    },
    methods: {
        update() {
            this.form.put('/tasks/' + this.task.id)
        },
        destroy() {
            this.form.delete('/tasks/' + this.task.id)
        },
        cancel() {
            this.form.reset();
        }
    },
    props: {
        task: Object,
    },
}

</script>
