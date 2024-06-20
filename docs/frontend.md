# Front-end 

## Pre-requisites
- [Node.js](https://nodejs.org/en/)

## Libraries
- [Vuetify](https://vuetifyjs.com/)

## Models
### Task
```
interface Task {
  id: number;
  task: string;
}
```

## Components
- `App` - Main component

### Task
- `TaskList` - List of tasks
- `TaskItem` - Each task item in the list
- `TaskAdd` - Add a new task 
- `TaskEdit` - Edit a task
- `TaskDelete` - Delete a task

## State
The general state of tasks is inside the `App` component. While this is not the best practice for a large application, given the time constraints, this is the simplest way to manage the state. 

### Methods
- `addTask` - Add a new task
- `editTask` - Edit a task
- `deleteTask` - Delete a task