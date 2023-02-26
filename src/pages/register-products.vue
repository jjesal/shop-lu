<template>
  <div id="app">
    <main-layout>
      <div class="background">
        <div class="main-form form-group my-mg-auto-x">
          <label>Registro de Productos</label>
          <form id="form_product" @submit="register">
            <div class="form-group">
              <input name="id" value="NULL" hidden>
              <label for="input_name">Nombre del producto</label>
              <input name="nombre_producto" required type="text" class="form-control" id="input_name"
                placeholder="Ingresar el nombre del producto...">
            </div>
            <div class="form-group">
              <label for="select_category">Categoría</label>
              <select name="categoria_id" required class="form-control" id="select_category">
                <option v-for="option in arrCategoria" :value="option.value">
                  {{ option.text }}
                </option>
              </select>
            </div>
            <div class="form-group">
              <label for="select_marca">Marca</label>
              <select name="marca_id" required class="form-control" id="select_marca">
                <option v-for="option in arrMarca" :value="option.value">
                  {{ option.text }}
                </option>
              </select>
            </div>

            <div class="form-group">
              <label for="input_image">Imagen del producto</label>
              <input name="imagen" required type="file" class="form-control-file" id="input_image">
            </div>

            <div class="form-group">
              <label for="input_desc">Descripción</label>
              <textarea name="descripcion" placeholder="Una breve descripción del producto..." class="form-control"
                id="input_desc" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="input_precio">Precio</label>
              <input name="precio" step="0.01" type="number" required class="form-control" id="input_precio"
                placeholder="S/.">
            </div>
            <div class="form-group">
              <label for="input_stock">stock</label>
              <input name="stock" type="number" required class="form-control" id="input_stock"
                placeholder="Cantidad de productos en stock">
            </div>
            <input class="my-btn" type="submit" value="Enviar">
          </form>
          <br><br>
          <list-items :arrItems="arrProducts" :arrHeadKey="arrHeadKey"></list-items>
        </div>
      </div>
    </main-layout>
  </div>
</template>

<script>
import MainLayout from '../layouts/main-layout.vue'
import listItems from "../components/list-items.vue"

export default {
  name: 'register-page',
  components: {
    MainLayout,
    listItems
  },
  data: () => {
    return {
      producto: {
        id: 'NULL',
        categoría: 1
      },
      arrCategoria: [],
      arrMarca: [],
      arrProducts: [],
      arrHeadKey: [
        { head: '#', key: 'id' },
        { head: 'Nombre', key: 'nombre_producto' },
        { head: 'Categoria', key: 'nombre_categoria' },
        { head: 'Marca', key: 'nombre_marca' },
        { head: 'Precio', key: 'precio' },
        { head: 'Stock', key: 'stock' }
      ]
    };
  },
  created: function () {
    console.log('mine ', 'created');
    this.$root.getData('listarCategoria').then(arrCategoria => {
      this.arrCategoria = arrCategoria.map(categoria => ({ value: categoria.id, text: categoria.nombre }))
    });
    this.$root.getData('listarMarca').then(arrMarca => {
      this.arrMarca = arrMarca.map(marca => ({ value: marca.id, text: marca.nombre }))
    });
    this.getList();
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
          this.reset();
          this.getList();
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
    },
    reset() {
      document.querySelector('#form_product').reset();
    },
    getList() {
      this.$root.getData('listarProducto').then(arrProducts => {
        this.arrProducts = arrProducts;
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