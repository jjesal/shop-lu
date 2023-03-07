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
  min-height: 35px;
  padding: 5px 10px;
  line-height: 1;
  background-color: transparent;
  cursor: pointer;
}

.my-btn:hover {
  background-color: var(--my-btn-color);
  color: var(--my-text-color);
}

.my-btn:disabled {
  color: gray;
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

@media screen and (min-width: 992px) and (max-width: 1199px) {

  /* Estilos para pantallas de 992px a 1199px */
  * {
    font-size: calc(100% + 0.5px) !important;
  }

}

@media screen and (min-width: 768px) and (max-width: 991px) {

  /* Estilos para pantallas de 768px a 991px */
  * {
    font-size: calc(100% + 0.5px) !important;
  }
}

@media screen and (max-width: 767px) {

  /* Estilos para pantallas de 767px o menos */
  * {
    font-size: calc(100% + 0.5px) !important;
  }
}
</style>
