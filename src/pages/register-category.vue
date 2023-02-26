<template>
  <div id="app">
    <main-layout>
      <div class="background">
        <div class="main-form form-group my-mg-auto-x">
          <label>Registro de Categorias</label>
          <form id="category-form" @submit="registerCategory">
            <div class="form-group">
              <input name="id" value="NULL" hidden>
              <label for="exampleFormControlInput1">Nombre de categoria</label>
              <input required name="nombre_categoria" type="text" class="form-control" id="exampleFormControlInput1"
                placeholder="Libros...">
            </div>

            <input class="my-btn" type="submit" value="Guardar">
          </form>
          <br><br>
          <list-items :arrItems="arrCategoria" :arrHeadKey="arrHeadKey"></list-items>
        </div>
      </div>
    </main-layout>
  </div>
</template>

<script>
import MainLayout from '../layouts/main-layout.vue'
import listItems from "../components/list-items.vue"

export default {
  name: 'register-category',
  components: {
    MainLayout,
    listItems
  },
  data: () => {
    return {
      categoria: {
        id: 'NULL',
        categoría: 1
      },
      arrCategoria: [],
      arrHeadKey: [{ head: '#', key: 'id' }, { head: 'Nombre', key: 'nombre' }]
    };
  },
  created: function () {
    this.getList();
  },
  methods: {
    registerCategory(e) {
      e.preventDefault();
      const formData = new FormData(document.querySelector('#category-form'))
      this.$root.postData('insertarCategoria', formData, 'form')
        .then((rs) => {
          console.log('rs', rs);
          document.querySelector('#category-form').reset();
          this.getList();
        })
        .catch(function () { })
    },
    getList() {
      this.$root.getData('listarCategoria').then(arrCategoria => {
        this.arrCategoria = arrCategoria;
      });
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
@import '../assets/css/bootstrap.min.css';

.background {
  /* background-color: ; */
  /* color: rgb(234, 53, 84); */
  height: 100vh;
  margin: 0;
  /* display: grid; */
}

.main-form {
  margin-top: 2rem;
  width: 60%;
  /* display: grid; */
  /* margin: auto; */
  /* align-self: center; */
  gap: 1rem;
  /* justify-content: center; */
  /* text-align: center; */
  font-size: 1.2rem;
}

.main-form>label {
  font-size: 45px;
}

.my-btn {
  margin: 0 auto;
  display: block;
}
</style>