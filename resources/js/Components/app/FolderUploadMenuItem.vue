<template>
    <MenuItem v-slot="{ active }">
        <a
            href="#"
            class="text-gray-700 block px-4 py-2 text-sm relative"
        >
            Upload Folder
            <input type="file" @change="onChange" class="absolute left-0 top-0 bottom-0 right-0 cursor-pointer opacity-0" multiple webkitdirectory>
        </a>
    </MenuItem>
</template>

<script setup>
import { FILE_UPLOAD_STARTED, emitter } from '@/event-bus.js';
import { MenuItem } from '@headlessui/vue';

function onChange(e) {
    emitter.emit(FILE_UPLOAD_STARTED, e.target.files);
}

</script>
