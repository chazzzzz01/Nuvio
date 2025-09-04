<template>
<jet-authenticated-layout>
<template #header>
<h2>{{ task.title }}</h2>
</template>
<div class="p-4">
<p>{{ task.description }}</p>
<p>Status: {{ task.status }}</p>
</div>
</jet-authenticated-layout>
</template>


<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
const task = usePage().props.value.task
</script>