<template>
  <div class="task-item">
    {{ task.task }}
    <div class="task-btns">
      <TaskEdit :task="task" :editTask="editTask" />
      <TaskDelete :index="task.id" :deleteTask="deleteTask" />
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import TaskEdit from "./Actions/TaskEdit.vue";
import TaskDelete from "./Actions/TaskDelete.vue";
import { Task } from "@/types/Task";

export default defineComponent({
  components: {
    TaskEdit,
    TaskDelete,
  },
  props: {
    task: {
      type: Object as () => Task,
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
  setup(props) {
    const dialog = ref(false);

    const deleteTaskHandler = () => {
      dialog.value = false;
      props.deleteTask();
    };

    return { dialog, deleteTaskHandler };
  },
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
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.task-btns {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}
</style>
