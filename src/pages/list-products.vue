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
                            <li><a href="#">Categoría 1 (10)</a></li>
                            <li><a href="#">Categoría 2 (20)</a></li>
                            <li><a href="#">Categoría 3 (20)</a></li>
                            <li><a href="#">Categoría 4 (30)</a></li>
                            <li><a href="#">Categoría 5 (20)</a></li>
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
                            <li><a href="#">Faber Castell</a></li>
                            <li><a href="#">Artesco</a></li>
                            <li><a href="#">Pilot</a></li>
                            <li><a href="#">Alpha</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <div class="card-heading">
                      <a data-toggle="collapse" data-target="#collapseThree">Filter Price</a>
                    </div>
                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                      <div class="card-body">
                        <div class="shop__sidebar__price">
                          <ul>
                            <li><a href="#">S/. 0.00 - S/. 50.00</a></li>
                            <li><a href="#">S/. 50.00 - S/. 100.00</a></li>
                            <li><a href="#">S/. 100.00 - S/. 150.00</a></li>
                            <li><a href="#">S/. 150.00 - S/. 200.00</a></li>
                            <li><a href="#">S/. 200.00 - S/. 250.00</a></li>
                            <li><a href="#">250.00+</a></li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="card">
                        <div class="card-heading">
                          <a data-toggle="collapse" data-target="#collapseSix">Tags</a>
                        </div>
                        <div id="collapseSix" class="collapse show" data-parent="#accordionExample">
                          <div class="card-body">
                            <div class="shop__sidebar__tags">
                              <a href="#">Product</a>
                              <a href="#">Bags</a>
                              <a href="#">Shoes</a>
                              <a href="#">Fashio</a>
                              <a href="#">Clothing</a>
                              <a href="#">Hats</a>
                              <a href="#">Accessories</a>
                            </div>
                          </div>
                        </div>
                      </div> -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="shop__product__option">
              <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                  <div class="shop__product__option__left">
                    <p>Mostrando 1–12 de 126 resultados</p>
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
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>Corrector</h6>
                    <a href="#" class="add-cart">+ Añadir al carrito</a>

                    <h5>S/. 67.24</h5>

                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-3.jpg">

                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>Plumón</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 43.48</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-4.jpg">
                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>Folder </h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 60.9</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-6.jpg">

                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>Ankle Boots</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 98.49</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-7.jpg">
                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>T-shirt Contrast Pocket</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 49.66</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-8.jpg">
                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>Basic Flowing Scarf</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 26.28</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-9.jpg">
                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>Piqué Biker Jacket</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 67.24</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-10.jpg">

                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>Multi-pocket Chest Bag</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 43.48</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-11.jpg">
                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>Diagonal Textured Cap</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 60.9</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-12.jpg">

                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>Ankle Boots</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 98.49</h5>

                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-13.jpg">
                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>T-shirt Contrast Pocket</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 49.66</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="product__item">
                  <div class="product__item__pic set-bg" data-setbg="img/product/product-14.jpg">
                    <ul class="product__hover">
                      <li><a href="#"><img src="img/icon/heart.png" alt=""></a></li>
                      <li><a href="#"><img src="img/icon/compare.png" alt=""> <span>Compare</span></a>
                      </li>
                      <li><a href="#"><img src="img/icon/search.png" alt=""></a></li>
                    </ul>
                  </div>
                  <div class="product__item__text">
                    <h6>Basic Flowing Scarf</h6>
                    <a href="#" class="add-cart">+ Add To Cart</a>

                    <h5>S/. 26.28</h5>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="product__pagination">
                  <a class="active" href="#">1</a>
                  <a href="#">2</a>
                  <a href="#">3</a>
                  <span>...</span>
                  <a href="#">21</a>
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

export default {
  components: {
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
