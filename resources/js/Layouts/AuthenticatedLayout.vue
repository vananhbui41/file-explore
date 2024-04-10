<template>
    <div class="h-screen bg-gray-50 flex w-full gap-4">
        <Navigation />
        <main
            class="flex flex-col flex-1 px-4 overflow-hidden"
            @drop.prevent="handleDrop"
            @dragover.prevent="onDragOver"
            @dragleave.prevent="onDragLeave"
            :class="dragOver ? 'dropzone' : ''"
        >
            <template
                v-if="dragOver"
                class="text-gray-500 text-center py-8 text-sm"
            >
                Drop files here to upload
            </template>
            <template v-else>
                <div class="flex items-center justify-between w-full">
                    <SearchForm />
                    <UserSettingDropdown />
                </div>
                <div class="flex-1 flex flex-col overflow-hidden">
                    <slot />
                </div>
            </template>
            <ErrorDialog />
            <FormProgress :form="fileUploadForm"/>
        </main>
    </div>
</template>

<script setup>
import Navigation from "@/Components/app/Navigation.vue";
import SearchForm from "@/Components/app/SearchForm.vue";
import UserSettingDropdown from "@/Components/app/UserSettingDropdown.vue";
import FormProgress from "@/Components/app/FormProgress.vue";
import { emitter, FILE_UPLOAD_STARTED, showErrorDialog } from "@/event-bus.js";
import { useForm, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import { onMounted } from "vue";
import ErrorDialog from "@/Components/app/ErrorDialog.vue";

const dragOver = ref(false);

const fileUploadForm = useForm({
    files: [],
    relative_paths: [],
    parent_id: null,
})

const page = usePage()

function uploadFiles(files) {
    fileUploadForm.parent_id = page.props.folder.id
    fileUploadForm.files = files
    fileUploadForm.relative_paths = [...files].map(f => f.webkitRelativePath)

    fileUploadForm.post(route('file.store'), {
        onSuccess: () => {
            // TODO
        },
        onError: errors => {
            let message = '';

            if (Object.keys(errors).length > 0) {
                message = errors[Object.keys(errors)[0]]
            } else {
                message = 'Something went wrong. Please try again later.'
            }

            showErrorDialog(message)

        },
        onFinish: () => {
            fileUploadForm.clearErrors()
            fileUploadForm.reset();
        },
    })
}

function onDragOver() {
    dragOver.value = true;
}

function onDragLeave() {
    dragOver.value = false;
}
function handleDrop(e) {
    dragOver.value = false;
    const files = e.dataTransfer.files;
    console.log(files);
    if (!files.length) {
        return;
    }
    uploadFiles(files);
}
onMounted(() => {
    emitter.on(FILE_UPLOAD_STARTED, uploadFiles);
});
</script>

<style scoped>
.dropzone {
    width: 100%;
    height: 100%;
    color: #8d8d8d;
    border: 2px dashed gray;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>
