<template>
  <div id="app">
    <!-- Shop Section Begin -->
    <section class="shop spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="shop__sidebar">
              <div class="shop__sidebar__search">
                <form action="#">
                  <input type="text" placeholder="Buscar...">
                  <button type="submit"><span class="icon_search"></span></button>
                </form>
              </div>
              <div class="shop__sidebar__accordion">
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <div class="card-heading">
                      <a data-toggle="collapse" data-target="#collapseOne">Categorías</a>
                    </div>
                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="shop__sidebar__categories">
                          <ul class="nice-scroll">
                            <li v-for="categoria in arrCategoria"><a @click="listarPorCategoria(categoria.id)" href="#">{{
                              categoria.nombre }}</a></li>
                            <li><a @click="listProducts()" href="#">Todas</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-heading">
                      <a data-toggle="collapse" data-target="#collapseTwo">Marcas</a>
                    </div>
                    <div id="collapseTwo" class="collapse show" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="shop__sidebar__brand">
                          <ul>
                            <li v-for="marca in arrMarca"><a @click="listarPorMarca(marca.id)" href="#">{{ marca.nombre
                            }}</a></li>
                            <li><a @click="listProducts()" href="#">Todas</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="shop__product__option">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="shop__product__option__left">
                    <p>Mostrando {{ arrProducts.length }} resultados</p>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="shop__product__option__right">
                    <p>Ordenar por precio:</p>
                    <select>
                      <option value="">Menor a Mayor</option>
                      <option value="">Mayor a Menor</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div v-for="producto in arrProducts" class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" :data-setbg="producto.precio"
                    :style="'background:url(data:image/png;base64,' + producto.imagen + ') no-repeat center center; background-size: cover;'">
                  </div>
                  <div class="product__item__text">
                    <h6>{{ producto.nombre_producto }} - <i>{{ producto.nombre_marca }}</i></h6>
                    <h5>S/. {{ parseFloat(producto.precio).toFixed(2) }}</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<style>
@import '../assets/css/bootstrap.min.css';
@import '../assets/css/font-awesome.min.css';
@import '../assets/css/elegant-icons.css';
@import '../assets/css/magnific-popup.css';
@import '../assets/css/nice-select.css';
@import '../assets/css/owl.carousel.min.css';
@import '../assets/css/slicknav.min.css';
@import '../assets/css/style.css';

.breadcrumb-option a {
  color: white;
}

a:hover {
  color: black;
}

a {
  color: black;
}

.logout-btn {
  padding-left: 10px;
}
</style>
<script>
import swal from 'sweetalert2';
export default {
  components: {
    swal
  },
  data: () => {
    return {
      arrProducts: [],
      arrCategoria: [],
      arrMarca: [],
      operadorFiltrado: '=',
      operadorBusqueda: 'LIKE',
      campoCategoria: 'categoria.id',
      campoMarca: 'marca.id',
      campoBusqueda: 'producto.nombre_producto'
    };
  },
  created: function () {
    this.listProducts();
    this.$root.getData('listarCategoria').then(arrCategoria => {
      this.arrCategoria = arrCategoria;
    });
    this.$root.getData('listarMarca').then(arrMarca => {
      this.arrMarca = arrMarca;
    });
  },
  methods: {
    addProductToCart(product) {
      const index = this.$root.userCart.findIndex(item => item.id === product.id);
      if (index == -1) {
        product.cantidad = 1;
        this.$root.userCart.push(product);
      } else {
        this.$root.userCart[index].cantidad++;
      }
      this.notifyProductAdded();
      console.log('mine producto,', this.$root.userCart);
    },
    notifyProductAdded() {
      swal.fire({
        position: 'bottom-end',
        icon: 'success',
        title: 'Producto agregado',
        showConfirmButton: false,
        timer: 750,
        // iconColor: 'rgb(234 53 84 / 39%)'
      })
    },
    listarPorCategoria(id) {
      const condiciones = {
        campo: this.campoCategoria,
        operador: this.operadorFiltrado,
        valor: id
      };
      this.listProducts(condiciones);
    },
    listarPorMarca(id) {
      const condiciones = {
        campo: this.campoMarca,
        operador: this.operadorFiltrado,
        valor: id
      };
      this.listProducts(condiciones);
    },
    listProducts(condiciones = {}) {
      this.$root.postData('listarProducto', condiciones).then(arrProducts => {
        this.arrProducts = arrProducts;
      });
    }
  }
}
</script>
