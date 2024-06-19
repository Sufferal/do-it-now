<script setup>
import TaskAdd from "./components/Task/Actions/TaskAdd.vue";
import TaskList from "./components/Task/TaskList.vue";
import { ref } from "vue";
import { onMounted } from "vue";

const tasks = ref([]);
const addTask = (task) => {
  tasks.value.push(task);
  localStorage.setItem("tasks", JSON.stringify(tasks.value));
};

const editTask = (index, task) => {
  tasks.value[index] = task;
  localStorage.setItem("tasks", JSON.stringify(tasks.value));
};

const deleteTask = (index) => {
  tasks.value.splice(index, 1);
  localStorage.setItem("tasks", JSON.stringify(tasks.value));
};

onMounted(() => {
  const savedTasks = localStorage.getItem('tasks');
  if (savedTasks) {
    tasks.value = JSON.parse(savedTasks);
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
