<template>
  <div class="container">
    <v-form v-model="valid" class="task-form">
      <v-text-field
        ref="form"
        class="task-add"
        v-model="task"
        :counter="50"
        :rules="taskRules"
        label="Task"
        required
      ></v-text-field>
      <v-btn
        class="task-add-btn"
        variant="tonal"
        size="x-large"
        @click="addTask"
        append-icon="mdi-plus"
      >
        Add
        <template v-slot:append>
          <v-icon></v-icon>
        </template>
      </v-btn>
    </v-form>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  data() {
    return {
      valid: false,
      task: "",
      taskRules: [
        (value) => !!value || "Task cannot be empty.",
        (value) =>
          value?.length <= 50 || "Task must be less than 50 characters.",
      ],
    };
  },
  methods: {
    addTask() {
      if (this.valid && this.task !== "") {
        fetch("https://localhost/do-it-now/backend/public/tasks", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ task: this.task }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.error) {
              console.error("Error:", data.error);
            } else {
              console.log("Success:", data);
              this.$emit("add-task", {
                id: Number(data.id),
                task: this.task
              });
              this.task = "";
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
.task-form {
  display: flex;
  justify-content: center;
  gap: 1.5rem;
}

.task-add {
  max-width: 30vw;
}

.task-add-btn {
  font-weight: bold;
  background-color: var(--secondary-color-dark);
}

.task-add:deep() .v-counter {
  color: var(--secondary-color-dark);
  font-weight: bold;
}

.task-add:deep() .v-messages__message {
  color: var(--error-color);
}

.task-add:deep()
  .v-field--error:not(.v-field--disabled)
  .v-label.v-field-label {
  color: var(--error-color);
}
</style>
