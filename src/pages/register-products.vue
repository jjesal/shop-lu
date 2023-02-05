<template>
  <div id="app">
    <main-layout>
      <div class="background">
        <div class="main-form form-group my-mg-auto-x">
          <label>Registro de Productos</label>
          <form @submit="register">
            <div class="form-group">
              <input name="id" value="NULL" hidden>
              <label for="exampleFormControlInput1">Nombre de producto</label>
              <input name="nombre_producto"  type="text" class="form-control" id="exampleFormControlInput1"
                placeholder="Lapicero...">
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Categoría</label>
              <select name="categoria_id" class="form-control" id="exampleFormControlSelect1">
                <option v-for="option in arrCategoria" :value="option.value">
                  {{ option.text }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlSelect1">Marca</label>
              <select name="marca_id" class="form-control" id="exampleFormControlSelect1">
                <option v-for="option in arrMarca" :value="option.value">
                  {{ option.text }}
                </option>
              </select>
            </div>

            <div class="form-group">
              <label for="exampleFormControlFile1">Imagen de producto</label>
              <input name="imagen" type="file" class="form-control-file" id="exampleFormControlFile1">
            </div>

            <div class="form-group">
              <label for="exampleFormControlTextarea1">Descripción</label>
              <textarea name="descripcion" class="form-control" id="exampleFormControlTextarea1"
                rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Precio</label>
              <input name="precio" type="number" class="form-control" id="exampleFormControlInput1"
                placeholder="S/.">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">stock</label>
              <input name="stock" type="number" class="form-control" id="exampleFormControlInput1"
                placeholder="20">
            </div>
            <input class="my-btn" type="submit" value="Enviar">
          </form>
        </div>
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
      producto: {
        id: 'NULL',
        categoría: 1
      },
      arrCategoria: [],
      arrMarca: []
    };
  },
  created: function () {
    console.log('mine ', 'created');
    this.$root.getData('listarCategoria').then(arrCategoria=>{
      this.arrCategoria=arrCategoria.map(categoria=>({value: categoria.id, text: categoria.nombre_categoria}))
    });
    this.$root.getData('listarMarca').then(arrMarca=>{
      this.arrMarca = arrMarca.map(marca=>({value: marca.id, text: marca.nombre_marca}))
    });
  },
  methods: {
    loadImage(event) {
      this.producto.imagen = event.target.files;
    },
    register(e) {
      e.preventDefault();
      const formData = new FormData(document.querySelector('.main-form form'))
      this.$root.postData('insertarProducto', formData, 'form')
        .then((rs) => {
          console.log('rs', rs);
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
@import '../assets/css/bootstrap.min.css';

.background {
  /* background-color: ; */
  /* color: rgb(234, 53, 84); */
  height: 100vh;
  width: 100vw;
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