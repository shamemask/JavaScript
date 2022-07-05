<template>
  <div id="app">
    <img alt="Vue logo" src="./assets/logo.png">
    <HelloWorld msg="Welcome to Your Vue.js App" />
    <ToDoList :todos="todos" @delete-todo="deleteTodo" />
  </div>

</template>

<script>
  import HelloWorld from './components/HelloWorld.vue'
  import ToDoList from './components/ToDoList.vue'
  export default {
    name: 'app',
    data() {
      return {
        todos: ['Repair', 'Breakfast']
      }
    },
    components: {
      ToDoList,
      HelloWorld
    },
    methods: {
      deleteTodo(index){
        this.todos.splice(index, 1);
      }
    }

  }
</script>

<style>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
</style>