<template>
  <v-btn
    class="task-delete-btn"
    icon="mdi-close-circle"
    @click="dialog = true"
  ></v-btn>
  <v-dialog v-model="dialog" max-width="500px">
    <v-card class="delete-card">
      <v-card-title class="headline"
        >Are you sure you want to delete this task?</v-card-title
      >
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn class="delete-btn" variant="flat" @click="deleteTaskHandler"
          >Delete</v-btn
        >
        <v-btn class="cancel-btn" variant="outlined" @click="dialog = false"
          >Cancel</v-btn
        >
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";

export default defineComponent({
  props: {
    deleteTask: {
      type: Function,
      required: true,
    },
    index: {
      type: Number,
      required: true,
    },
  },
  setup(props) {
    const dialog = ref(false);
    const deleteTaskHandler = () => {
      dialog.value = false;
      fetch(`https://localhost/do-it-now/backend/public/tasks/${props.index}`, {
        method: "DELETE",
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.error) {
            console.error("Error:", data.error);
          } else {
            console.log("Success:", data);
            props.deleteTask(props.index);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    };
    return { dialog, deleteTaskHandler };
  },
});
</script>

<style scoped>
.task-delete-btn {
  background-color: var(--error-color);
}
.delete-card:deep() .headline {
  color: var(--background-color) !important;
}
.delete-btn {
  background-color: var(--error-color);
}
.cancel-btn {
  color: var(--secondary-color-dark);
}
.delete-btn:deep() .v-btn__content {
  color: var(--primary-color);
  font-weight: bold;
}
.cancel-btn:deep() .v-btn__content {
  color: var(--secondary-color-dark);
  font-weight: bold;
}
</style>
