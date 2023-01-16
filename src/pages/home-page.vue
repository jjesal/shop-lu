<template>
  <div id="app">
    <main-layout>
      <div>
        <!-- Offcanvas Menu Begin -->
        <div class="offcanvas-menu-overlay"></div>
        <div class="offcanvas-menu-wrapper">
          <div class="offcanvas__option">
            <div class="offcanvas__links">
              <a href="#">Sign in</a>
              <a href="#">FAQs</a>
            </div>
            <div class="offcanvas__top__hover">
              <span>Usd <i class="arrow_carrot-down"></i></span>
              <ul>
                <li>USD</li>
                <li>EUR</li>
                <li>USD</li>
              </ul>
            </div>
          </div>
          <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
            <a href="#"><img src="img/icon/heart.png" alt=""></a>
            <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">S/. 0.00</div>
          </div>
          <div id="mobile-menu-wrap"></div>
          <div class="offcanvas__text">
            <p>Free shipping, 30-day return or refund guarantee.</p>
          </div>
        </div>
        <!-- Offcanvas Menu End -->

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
                    <li class="active"><a v-on:click="view='list-products'" href="#">Inicio</a></li>
                    <li><a v-on:click="view='register-products'" href="#">Registrar productos</a></li>
                    <li><a v-on:click="view='register-category'" href="#">Mantenimiento</a></li>
                    <li><a href="#">Páginas</a>
                      <ul class="dropdown">
                        <li><a href="./shop-details.html">Shop Details</a></li>
                        <li><a href="./shopping-cart.html">Shopping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>
              <div class="col-lg-3 col-md-3">
                <div class="header__nav__option">
                  <a href="#" class="search-switch"><img src="img/icon/search.png" alt=""></a>
                  <a href="#"><img src="img/icon/cart.png" alt=""> <span>0</span></a>
                  <div class="price">S/. 0.00</div>
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
                  <h4>Sumaq Yawa</h4>
                  <div class="breadcrumb__links">
                    <a href="./index.html">Inicio</a>
                    <span>Productos</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Breadcrumb Section End -->
        <component :is="view"></component>
        <!-- <list-products></list-products> -->
      </div>
    </main-layout>
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
import MainLayout from '../layouts/main-layout.vue'
import listProducts from '../pages/list-products.vue'
import registerProducts from '../pages/register-products.vue'
import registerCategory from '../pages/register-category.vue'

export default {
  components: {
    MainLayout,
    listProducts,
    registerProducts,
    registerCategory
  },
  data: () => {
    return {
      view: 'list-products'
    };
  },
  methods: {
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
