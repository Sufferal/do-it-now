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
        this.$emit("add-task", this.task);
        this.task = "";
        this.$refs.form.resetValidation();
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
  color: var(--secondary-color-dark) !important;
  font-weight: bold;
}

.task-add:deep() .v-messages__message {
  color: var(--error-color) !important;
}

.task-add:deep()
  .v-field--error:not(.v-field--disabled)
  .v-label.v-field-label {
  color: var(--error-color) !important;
}
</style>
