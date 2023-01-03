<template>
  <div id="app">
    <main-layout>
      <div class="background">
        <form action="">
          <label>Iniciar Sesión</label>
          <input class="user" placeholder="Usuario"/>
          <input class="pass" placeholder="Contraseña"/>
          <a class="my-btn" href="#">Registrarse</a>
        </form>
      </div>
  </main-layout>
  </div>
</template>

<script>
  import MainLayout from '../layouts/main-layout.vue'

  export default {
    components: {
      MainLayout
    }
  }
</script>

<style scoped>
  .background {
    background-color: rgb(234, 53, 84);
    color: white;
    height: 100vh;
    width: 100vw;
    margin: 0;
    display: grid;
  }
  form {
    width: 400px;
    display: grid;
    margin: auto;
    align-self: center;
    gap: 1rem;
    justify-content: center;
    text-align: center;
    font-size: 1.2rem;
  }
  form > label{
    font-size: 45px;
  }
  .my-btn {
    --my-btn-color: white;
    margin: 0 30px;
  }
</style>