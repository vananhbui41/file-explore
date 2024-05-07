<template>
    <transition enter-active-class="ease-out duration-300">
        <div
            v-if="show"
            class="fixed bottom-4 left-4 text-white py-2 px-4 rounded-lg shadow-sm w-[200px]"
            :class="{
                'bg-emerald-500': type === 'success',
                'bg-red-500': type === 'error',
            }"
        >
            {{ message }}
        </div>
    </transition>
</template>

<script setup>
// Imports
import { SHOW_NOTIFICATION, emitter } from "@/event-bus";
import { onMounted, ref } from "vue";

// Refs
const show = ref(false);
const message = ref("");
const type = ref("success");

// Methods
function close() {
    show.value = false;
    type.value = "";
    message.value = "";
}

// Hooks
onMounted(() => {
    let timeout;
    emitter.on(SHOW_NOTIFICATION, ({ type: t, message: msg }) => {
        show.value = true;
        type.value = t;
        message.value = msg;

        if (timeout) clearTimeout(timeout);
        timeout = setTimeout(() => {
            close();
        }, 5000);
    });
});
</script>
