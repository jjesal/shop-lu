<template>
  <div class="my-container">
    <slot></slot>
  </div>
</template>

<script>

</script>

<style>
:root {
  --my-btn-color: black;
  --my-text-color: white;
}

.my-container {
  margin: 0 auto;
  padding: 0;
}

.my-mg-auto-x {
  margin: 0 auto;
}

* {
  box-sizing: border-box;
  font-family: 'Segoe UI Light', Tahoma, Geneva, Verdana, sans-serif;
}

a {
  text-decoration: none;
  cursor: pointer;
}

html,
body {
  padding: 0;
  margin: 0;
}

input {
  border-radius: 20px;
  border: 0;
  outline: 0;
  height: 35px;
  padding-left: 10px;
  min-width: 260px;
}

.my-btn {
  border: 1px solid;
  color: var(--my-btn-color);
  border-radius: 20px;
  height: 35px;
  padding: 5px 10px;
  line-height: 1;
  background-color: transparent;
  cursor: pointer;
}

.my-btn:hover {
  background-color: var(--my-btn-color);
  color: var(--my-text-color);
  font-weight: 600;
}

.my-link {
  color: var(--my-text-color);
  font-size: 1rem;
}

.envolve {
  left: 0;
  top: 0;
}

.swal-button {
  background-color: rgb(234, 53, 84);
}

.swal-button:not([disabled]):hover {
  background-color: rgba(234, 53, 83, 0.524);
}
</style>
