<template>
<jet-authenticated-layout>
<template #header>
<h2>Create Task</h2>
</template>


<form @submit.prevent="submit">
<div>
<label>Title</label>
<input v-model="form.title" />
</div>
<div>
<label>Description</label>
<textarea v-model="form.description"></textarea>
</div>
<div>
<label>Status</label>
<select v-model="form.status">
<option value="todo">To do</option>
<option value="in_progress">In progress</option>
<option value="done">Done</option>
</select>
</div>
<button type="submit">Save</button>
</form>
</jet-authenticated-layout>
</template>


<script setup>
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'


const form = reactive({ title: '', description: '', status: 'todo' })


function submit(){
Inertia.post('/tasks', form)
}
</script>