<template>
  <div id="app">
    <main-layout>
      <div class="background">
        <form @submit="login">
          <label>Iniciar Sesión</label>
          <input v-model="user.acc" class="user" placeholder="Usuario" required />
          <input v-model="user.pass" class="pass" type="password" placeholder="Contraseña" required />
          <input class="my-btn" type="submit" value="Enviar">
          <a class="my-link" @click="$root.navigate('register')">Aún no tienes una cuenta? Regístrate <i>aquí</i></a>

        </form>
      </div>
      <spinner-veil v-if="$root.loadingPetition" />
    </main-layout>
  </div>
</template>

<script>
import MainLayout from '../layouts/main-layout.vue'
import spinnerVeil from "../components/spinner-veil.vue"

export default {
  components: {
    MainLayout,
    spinnerVeil
  },
  data: () => {
    return {
      user: {}
    };
  },
  mounted(){

  },
  methods: {
    login(e) {
      e.preventDefault();
      this.validate();
      this.$root.postData('comprobarUsuario', { user: this.user })
        .then(() => {
          this.$root.navigate('home')
        })
        .catch(function () { })
    },
    validate() {
      //borra espacios en blanco
      this.user.acc.trim();
      this.user.pass.trim();
      console.log("user: ", this.user.acc, ", pass: ", this.user.pass);
    }
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
  width: 350px;
  display: grid;
  margin: auto;
  align-self: center;
  gap: 1rem;
  justify-content: center;
  text-align: center;
  font-size: 1.2rem;
}

form>label {
  font-size: 45px;
}

input {
  width: 300px;
  margin: auto;
}

.my-btn {
  --my-btn-color: white;
  --my-text-color: rgb(234, 53, 84);
  width: 170px;
  margin: 0 60px;
}
</style>