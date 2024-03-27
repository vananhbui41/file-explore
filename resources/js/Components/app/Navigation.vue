<template>
    <nav class="min-w-[200px]">
        <div class="h-[80px] px-3 flex items-center gap-3">
            <Link href="/">
                <ApplicationLogo
                    class="block h-9 w-auto fill-current text-gray-800"
                />
            </Link>
            LaraStorage
        </div>
        <div class="px-3">
            <CreateNewDropdown />
            
            <div class="py-3">
                <NavLink href="/">My Files</NavLink>
                <NavLink href="/">Shared with me</NavLink>
                <NavLink href="/">Share by me</NavLink>
                <NavLink href="/" :active="true">Trash</NavLink>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import CreateNewDropdown from "@/Components/app/CreateNewDropdown.vue";

</script>

<style scoped>
</style>
