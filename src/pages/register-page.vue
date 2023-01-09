<template>
  <div id="app">
    <main-layout>
      <div class="background">
        <form @submit="register">
          <label>Registro</label>
          <input v-model="persona.nombres" placeholder="Nombres" required />
          <input v-model="persona.apellidos" placeholder="Apellidos" required />
          <input v-model="persona.dni" placeholder="DNI" maxlength="8" required />
          <input v-model="persona.celular" placeholder="Celular" maxlength="9" required />
          <input v-model="persona.correo" placeholder="Correo electrónico" type="email" required />
          <input v-model="persona.password" placeholder="Contraseña" type="password" required />
          <input class="my-btn" type="submit" value="Enviar">
        </form>
      </div>
    </main-layout>
  </div>
</template>

<script>
import MainLayout from '../layouts/main-layout.vue'

export default {
  name: 'register-page',
  components: {
    MainLayout
  },
  data: () => {
    return {
      persona: {
        id: 'NULL',
        rol_id: 3
      }
    };
  },
  created: function () {
    console.log('mine ', 'created');
  },
  methods: {
    validate() {
      //borra espacios en blanco
      this.user.acc.trim();
      this.user.pass.trim();
      console.log("user: ", this.user.acc, ", pass: ", this.user.pass);
      this.login();
    },
    register(e) {
      e.preventDefault();
      this.$root.postData('insertarPersonal', { persona: this.persona })
        .then(() => {
          this.$root.navigate('login')
        })
        .catch(function () { })
    },
    isLoggedIn(bool) {
      //si es true, es llamado por login
      // comprueba si ya existe la sesion en el servidor

      this.axios
        .post(
          document.pathdev + "/php/mainController.php?op=isLoggedIn",
          {},
          { withCredentials: true }
        )
        .then(respuesta => {
          if (respuesta.data.connected) {
            //si ya está conectado
            if (this.$router.currentRoute.path != "/inicio") {
              this.$router.push("/inicio"); //redirige a vista principal
            }
            this.$root.usuario.acc = respuesta.data.acc;
          } else {
            if (bool) {
              console.log("asignando valor a let msg");
              this.msgError = "¡Datos incorrectos!";
            }
          }

          this.loaded = true;
        });
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
  width: 400px;
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

.my-btn {
  --my-btn-color: white;
  --my-text-color: rgb(234, 53, 84);
  margin: 0 30px;
}
</style>