<template>
  <v-btn class="task-edit-btn" icon="mdi-pencil" @click="dialog = true"></v-btn>
  <v-dialog v-model="dialog" max-width="500px">
    <v-card class="edit-card">
      <v-card-title class="headline"
        >Update task:
        <span class="highlight-task">{{ task.task }}</span></v-card-title
      >
      <v-form v-model="valid" class="task-form">
        <v-text-field
          ref="form"
          class="task-edit"
          v-model="taskUpdate"
          :counter="50"
          :rules="taskRules"
          label="Task"
          required
        ></v-text-field>
      </v-form>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn class="edit-btn" variant="flat" @click="editTaskHandler"
          >Update</v-btn
        >
        <v-btn class="cancel-btn" variant="outlined" @click="dialog = false"
          >Cancel</v-btn
        >
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script lang="ts">
import { Task } from "@/types/Task";
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    editTask: {
      type: Function,
      required: true,
    },
    task: {
      type: Object as () => Task,
      required: true,
    },
  },
  data() {
    return {
      dialog: false,
      taskUpdate: "",
      valid: false,
      taskRules: [
        (value) => !!value || "Task cannot be empty.",
        (value) =>
          value?.length <= 50 || "Task must be less than 50 characters.",
      ],
    };
  },
  watch: {
    task: {
      immediate: true,
      handler(newVal) {
        this.taskUpdate = newVal.task;
      },
    },
  },
  methods: {
    editTaskHandler() {
      if (this.valid) {
        fetch(`https://localhost/do-it-now/backend/public/tasks/${this.task.id}`, {
          method: "PUT",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ task: this.taskUpdate }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.error) {
              console.error("Error:", data.error);
            } else {
              console.log("Success:", data);
              this.dialog = false;
              this.editTask(this.task.id, this.taskUpdate);
              this.taskUpdate = "";
              this.$refs.form.resetValidation();
            }
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      }
    },
  },
});
</script>

<style scoped>
.highlight-task {
  color: var(--secondary-color-dark);
  font-weight: bold;
}

.task-edit-btn {
  background-color: var(--background-color);
}
.edit-card:deep() .headline {
  color: var(--background-color) !important;
}
.edit-btn {
  background-color: var(--secondary-color-dark);
}
.cancel-btn {
  color: var(--secondary-color-dark);
}
.edit-btn:deep() .v-btn__content {
  color: var(--primary-color);
  font-weight: bold;
}
.cancel-btn:deep() .v-btn__content {
  color: var(--secondary-color-dark);
  font-weight: bold;
}
.task-form {
  width: 90%;
  margin: 2rem auto;
}

.edit-card:deep() .v-input__control {
  border-bottom: 2px solid var(--secondary-color-dark);
}
.task-edit:deep() .v-label {
  color: var(--secondary-color-dark);
}
.task-edit:deep() .v-field__input {
  color: var(--secondary-color-dark);
}
.task-edit:deep() .v-counter {
  color: var(--secondary-color-dark);
  font-weight: bold;
}

.task-edit:deep() .v-messages__message {
  color: var(--error-color);
}

.task-edit:deep()
  .v-field--error:not(.v-field--disabled)
  .v-label.v-field-label {
  color: var(--error-color);
}
</style>
