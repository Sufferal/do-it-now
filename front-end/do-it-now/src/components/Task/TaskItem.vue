<template>
  <div class="task-item">
    {{ task }}
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({
  props: {
    task: {
      type: String,
      required: true
    }
  }
});
</script>

<style scoped>
.task-item {
  background-color: var(--secondary-color-dark);
  padding: 0.75rem;
  letter-spacing: 0.1rem;
  text-align: left;
  border-radius: 5px;
  min-width: 30vw;
}
</style>