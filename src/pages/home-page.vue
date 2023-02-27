<template>
  <div id="app">
    <main-layout>
      <div>
        <!-- Header Section Begin -->
        <header class="header">
          <div class="x-container">
            <div class="row">
              <div class="col-lg-3 col-md-3">
                <div class="header__logo">
                  <a href="./index.html"><img src="img/logo.png" alt=""></a>
                </div>
              </div>
              <div class="col-lg-6 col-md-6">
                <nav class="header__menu mobile-menu">
                  <ul>
                    <li class="active" @click="manageActive($event)"><a
                        v-on:click="() => { view.page = 'list-products'; view.title = 'Productos' }">Inicio</a>
                    </li>
                    <li id="menu-carrito" @click="manageActive($event)"><a
                        v-on:click="() => { view.page = 'car-page'; view.title = 'Carrito' }">Carrito</a></li>
                    <!-- <li><a >xx</a></li> -->
                    <li v-if="$root.userLogged.rol_id===1" id="dropmenu"><a>Mantenimiento</a>
                      <ul class="dropdown">
                        <li @click="manageActive($event, 'dropmenu')"><a
                            v-on:click="() => { view.page = 'register-category'; view.title = 'Categorías' }"
                            href="#">Categorías</a></li>
                        <li @click="manageActive($event, 'dropmenu')"><a
                            v-on:click="() => { view.page = 'register-mark'; view.title = 'Marcas' }" href="#">Marcas</a></li>
                        <li @click="manageActive($event, 'dropmenu')"><a
                            v-on:click="() => { view.page = 'register-products'; view.title = 'Registrar producto' }"
                            href="#">Registrar producto</a></li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
              <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                  <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                  <a @click="manageActive($event, 'menu-carrito')"><i
                      v-on:click="() => { view.page = 'car-page'; view.title = 'Carrito' }" class="bi bi-cart"></i></a>
                  <div class="price">{{ this.$root.userCart.length }}</div>
                  <a href="#" @click="logout" class="logout-btn">Cerrar sesión</a>
                </div>
              </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
          </div>
        </header>
        <!-- Header Section End -->

        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-option">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="breadcrumb__text">
                  <h4>Sumaq Yawar</h4>
                  <div class="breadcrumb__links">
                    <!-- <a href="./index.html">Inicio</a> -->
                    <span>> {{ view.title }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Breadcrumb Section End -->
        <component :is="view.page"></component>
        <!-- <list-products></list-products> -->
      </div>
      <spinner-veil v-if="$root.loadingPetition" />
    </main-layout>
  </div>
</template>
<style>
/* @import '../assets/css/bootstrap.min.css'; */
@import '../assets/css/font-awesome.min.css';
@import '../assets/css/elegant-icons.css';
@import '../assets/css/magnific-popup.css';
@import '../assets/css/nice-select.css';
@import '../assets/css/owl.carousel.min.css';
@import '../assets/css/slicknav.min.css';
@import '../assets/css/style.css';
@import 'bootstrap-icons/font/bootstrap-icons.css';

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

.x-container .row {
  margin: auto;
}
</style>
<script>
import MainLayout from '../layouts/main-layout.vue'
import listProducts from '../pages/list-products.vue'
import registerProducts from '../pages/register-products.vue'
import registerCategory from '../pages/register-category.vue'
import registerMark from '../pages/register-mark.vue'
import carPage from '../pages/car-page.vue'
import spinnerVeil from "../components/spinner-veil.vue"
import swal from 'sweetalert2';

export default {
  components: {
    MainLayout,
    listProducts,
    registerProducts,
    registerCategory,
    registerMark,
    carPage,
    spinnerVeil,
    swal
  },
  data: () => {
    return {
      view: {
        page: 'list-products',
        title: 'Productos'
      }
    };
  },
  created: function () {
    console.log('mine holaaa');
  },
  methods: {
    manageActive(event, alternative) {
      const arrMenu = document.querySelectorAll('.header__menu.mobile-menu>ul>li');
      arrMenu.forEach(element => {
        element.classList.remove('active');
      });
      if (!alternative) {
        event.target.parentElement.classList.add('active');
      } else {
        document.querySelector(`#${alternative}`).classList.add('active');
      }
    },
    logout() {
      this.$root.getData('cerrarSesion')
        .then(() => {
          this.$root.navigate('login')
        })
        .catch(function () { })
    }
  }
}
</script>
