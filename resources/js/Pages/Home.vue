<script setup lang="ts">
const props = defineProps<{
    title?: string;
}>();
</script>

<template>
    <h1 class="underline">HOME - {{ props.title }}</h1>
</template>

<style scoped lang="sass">
h1
    @apply text-4xl text-red-500
</style>
