<template>
<jet-authenticated-layout>
<template #header>
<h2>Edit Task</h2>
</template>


<form @submit.prevent="submit">
<input type="hidden" v-model="form.id" />
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
<button type="submit">Update</button>
</form>
</jet-authenticated-layout>
</template>


<script setup>
import { Inertia } from '@inertiajs/inertia'
import { reactive } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'


const page = usePage()
const task = page.props.value.task


const form = reactive({
id: task.id,
title: task.title,
description: task.description,
status: task.status,
})


function submit(){
Inertia.put(`/tasks/${form.id}`, form)
}
</script>