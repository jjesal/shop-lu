<template>
  <div class="container">
    <slot></slot>
  </div>
</template>

<script>

  export default {
  }
</script>

<style>
  :root {
    --my-btn-color: black;
    --my-text-color: white;
  }
  .container {
    margin: 0 auto;
    padding: 0;
  }
  * {
    box-sizing: border-box;
    font-family: 'Segoe UI Light', Tahoma, Geneva, Verdana, sans-serif;
  }
  a {
    text-decoration: none;
  }
  html, body {
    padding: 0;
    margin: 0;
  }
  input{
    border-radius: 20px;
    border: 0;
    outline: 0;
    height: 35px;
    padding-left: 10px;
  }
  .my-btn {
    border: 1px solid;
    color: var(--my-btn-color);
    border-radius: 20px;
    height: 35px;
  }
  .my-btn:hover {
    background-color: var(--my-btn-color);
    color: var(--my-text-color)
  }
</style>
