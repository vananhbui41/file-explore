<template>
    <span>
        <svg
            v-if="file.is_folder"
            class="w-8 h-8 inline-flex justify-center items-center mr-2"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke-width="1.5"
            stroke="currentColor"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
            />
        </svg>
        <template v-else>
            <img
                class="w-8 h-8 max-w-full inline-flex justify-center items-center mr-2"
                v-if="isImage(file)"
                :src="`/images/icons/photo.png`"
            />
            <img
                class="w-8 h-8 max-w-full inline-flex justify-center items-center mr-2"
                v-else-if="isVideo(file)"
                :src="`/images/icons/video-camera.png`"
            />
            <img
                class="w-8 h-8 max-w-full inline-flex justify-center items-center mr-2"
                v-else-if="isAudio(file)"
                :src="`/images/icons/speaker-filled-audio-tool.png`"
            />
            <img
                class="w-8 h-8 max-w-full inline-flex justify-center items-center mr-2"
                v-else-if="isPdf(file)"
                :src="`/images/icons/pdf-file.png`"
            />
            <img
                class="w-8 h-8 max-w-full inline-flex justify-center items-center mr-2"
                v-else-if="isWord(file)"
                :src="`/images/icons/word.png`"
            />
            <img
                class="w-8 h-8 max-w-full inline-flex justify-center items-center mr-2"
                v-else-if="isExcel(file)"
                :src="`/images/icons/excel.png`"
            />
            <img
                class="w-8 h-8 max-w-full inline-flex justify-center items-center mr-2"
                v-else-if="isPpt(file)"
                :src="`/images/icons/powerpoint.png`"
            />
            <img
                class="w-8 h-8 max-w-full inline-flex justify-center items-center mr-2"
                v-else-if="isText(file)"
                :src="`/images/icons/txt-file-symbol.png`"
            />
            <img
                class="w-8 h-8 max-w-full inline-flex justify-center items-center mr-2"
                v-else-if="isZip(file)"
                :src="`/images/icons/zip-file-format.png`"
            />
            <img
                class="w-8 h-8 max-w-full inline-flex justify-center items-center mr-2"
                v-else
                :src="`/images/icons/attach-file.png`"
            />
        </template>
    </span>
</template>

<script setup>
// Imports
import {
    isImage,
    isVideo,
    isAudio,
    isPdf,
    isWord,
    isExcel,
    isPpt,
    isText,
    isZip,
} from "@/Helper/file-helper.js";

// Props & Emits
const { file } = defineProps({
    file: Object,
});
</script>
