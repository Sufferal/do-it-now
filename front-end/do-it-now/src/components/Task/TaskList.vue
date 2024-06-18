<template>
  <div class="task-list">
    <TaskItem
      v-for="(task, index) in tasks"
      :key="index"
      :index="index"
      :task="task"
    />
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import TaskItem from "./TaskItem.vue";

export default defineComponent({
  components: {
    TaskItem,
  },
  props: {
    tasks: {
      type: Array as () => string[],
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
