<template>
    <AuthenticatedLayout>
        <nav class="flex items-center justify-between p-1 mb-3">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li
                    v-for="ans of ancestors.data"
                    :key="ans.id"
                    class="inline-flex items-center"
                >
                    <div v-if="!ans.parent_id" class="flex items-center">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            class="w-5 h-5"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z"
                                clip-rule="evenodd"
                            />
                        </svg>

                        <Link
                            :href="route('my-files')"
                            class="ml-1 inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
                        >
                            My Files
                        </Link>
                    </div>
                    <div v-else class="flex items-center">
                        <svg
                            aria-hidden="true"
                            class="w-6 h-6 text-gray-400"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                        <Link
                            :href="route('my-files', { folder: ans.path })"
                            class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white"
                        >
                            {{ ans.name }}
                        </Link>
                    </div>
                </li>
            </ol>
        </nav>
        <table class="min-w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th
                        class="text-sm font-medium text-grat-900 px-6 py-4 text-left"
                    >
                        Name
                    </th>
                    <th
                        class="text-sm font-medium text-grat-900 px-6 py-4 text-left"
                    >
                        Owner
                    </th>
                    <th
                        class="text-sm font-medium text-grat-900 px-6 py-4 text-left"
                    >
                        Last Modified
                    </th>
                    <th
                        class="text-sm font-medium text-grat-900 px-6 py-4 text-left"
                    >
                        Size
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr
                    v-for="file of files.data"
                    :key="file.id"
                    @dblclick="openFolder(file)"
                    class="bg-white boder-b transition duration-300 ease-in-out hover:bg-gray-100 cursor-pointer"
                >
                    <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 flex items-center"
                    >
                        <FileIcon :file="file"/>
                        {{ file.name }}
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                    >
                        {{ file.owner }}
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                    >
                        {{ file.updated_at }}
                    </td>
                    <td
                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"
                    >
                        {{ file.size }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div
            v-if="!files.data.length"
            class="py-8 text-center text-sm text-gray-400"
        >
            There is no data in this folder
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Link, router } from "@inertiajs/vue3";
import FileIcon from "@/Components/app/FileIcon.vue";

const { files } = defineProps({
    files: Object,
    folder: Object,
    ancestors: Object,
});

// Methods
function openFolder(file) {
    if (!file.is_folder) {
        return;
    }

    router.visit(route("my-files", { folder: file.path }));
}
</script>
