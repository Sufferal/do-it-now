<template>
  <div class="task-list">
    <TaskItem
      v-for="(task, index) in tasks"
      :key="index"
      :task="task"
      :editTask="editTask"
      :deleteTask="deleteTask"
    />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import { Task } from "@/types/Task";
import TaskItem from "./TaskItem.vue";

export default defineComponent({
  components: {
    TaskItem,
  },
  props: {
    tasks: {
      type: Array as () => Array<Task>,
      required: true,
    },
    editTask: {
      type: Function,
      required: true,
    },
    deleteTask: {
      type: Function,
      required: true,
    },
  },
});
</script>

<style scoped>
.task-list {
  margin-top: 3rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 2rem;
}
</style>
