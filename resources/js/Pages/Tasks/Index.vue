<template>
<jet-authenticated-layout>
<template #header>
<h2 class="font-semibold text-xl">Tasks</h2>
</template>


<div class="p-4">
<Link href="/tasks/create" class="btn">Create Task</Link>


<div class="mt-4">
<div v-for="task in tasks.data" :key="task.id" class="p-4 border rounded mb-2">
<h3 class="font-bold">{{ task.title }}</h3>
<p>{{ task.description }}</p>
<div class="mt-2 text-sm">
<Link :href="`/tasks/${task.id}/edit`">Edit</Link>
<form :action="`/tasks/${task.id}`" method="post" @submit.prevent="destroy(task.id)">
<input type="hidden" name="_method" value="delete" />
<button type="submit">Delete</button>
</form>
</div>
</div>
</div>


<div class="mt-4">
<Pagination :links="tasks.links" />
</div>
</div>
</jet-authenticated-layout>
</template>


<script setup>
import { Link, usePage } from '@inertiajs/inertia-vue3'
import { Inertia } from '@inertiajs/inertia'
import Pagination from '@/Shared/Pagination.vue'


const props = defineProps({
tasks: Object,
})


function destroy(id){
if(!confirm('Delete this task?')) return
Inertia.delete(`/tasks/${id}`)
}
</script>