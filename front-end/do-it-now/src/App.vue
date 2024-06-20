<script setup>
import TaskAdd from "./components/Task/Actions/TaskAdd.vue";
import TaskList from "./components/Task/TaskList.vue";
import { ref } from "vue";
import { onMounted } from "vue";

const tasks = ref([]);
const addTask = (task) => {
  tasks.value.push(task);
};

const editTask = (index, task) => {
  // Get task with index and update it
  const taskIndex = tasks.value.findIndex((t) => t.id === index);
  tasks.value[taskIndex].task = task;
};

const deleteTask = (index) => {
  tasks.value = tasks.value.filter(task => task.id !== index);
};

onMounted(async () => {
  const response = await fetch('http://localhost/do-it-now/backend/public/tasks');
  if (!response.ok) {
    console.error('HTTP error', response.status);
  } else {
    const data = await response.json();
    tasks.value = data;
  }
});
</script>

<template>
  <div class="app-wrapper">
    <h1 class="app-title">Do it <span class="highlight-primary">Now</span></h1>
    <TaskAdd @add-task="addTask"/>
    <TaskList :tasks="tasks" :editTask="editTask" :deleteTask="deleteTask" />
  </div>
</template>

<style scoped>
.app-title {
  text-align: center;
  color: var(--secondary-color);
  margin: 3rem 0;
  font-size: 2.5rem;
}
</style>
