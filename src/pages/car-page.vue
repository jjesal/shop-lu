<template>
  <div id="app">
    <main-layout>
      <div v-if="showSummary" class="background">
        <main>
          <h2>Compra realizada con éxito</h2>
          <p>
            Código de orden: <b>{{ codigoOrden }}</b>
          </p>
        </main>
      </div>
      <div v-else class="background">
        <header>
          <h1><i class="bi bi-cart"></i> Carrito de compras</h1>
        </header>
        <main v-if="existenItems">
          <section id="cart-items">
            <h2>Artículos en el carrito</h2>
            <ul>
              <li v-for="(producto, index) in $root.userCart">
                <div class="product">
                  <div class="item-image"
                    :style="'background:url(data:image/png;base64,' + producto.imagen + ') no-repeat center center; background-size: cover;'">
                  </div>
                  <div class="item-details">
                    <h3>{{ producto.nombre_producto }}</h3>
                    <p>{{ producto.nombre_marca }}</p>
                    <p>Precio: S/. {{ producto.precio }}</p>
                  </div>
                </div>
                <div class="item-quantity">
                  <button @click="decreaseQuantity(producto, index)" class="quantity-button minus">-</button>
                  <span class="quantity">{{ producto.cantidad }}</span>
                  <button @click="increaseQuantity(producto)" class="quantity-button plus">+</button>
                </div>
              </li>
            </ul>
          </section>
          <section id="summary">
            <h2>Resumen de la compra</h2>
            <div id="summary-details">
              <!-- <p>Subtotal: $50</p>
              <p>Envío: Gratis</p> -->
              <p>Total: S/. {{ calcularCostoTotal }}</p>
            </div>
            <button @click="register()" id="checkout-button" class="my-btn">Registrar pedido</button>
          </section>
        </main>
        <main v-else>
          <div>
            <h2>Su carrito está vacio</h2>
            <p>Para seguir comprando, navegar por las categorías en el sitio, o busque su producto.</p>
            <button class="my-btn">Elegir productos</button>
          </div>
        </main>

      </div>

    </main-layout>
  </div>
</template>

<script>
import MainLayout from '../layouts/main-layout.vue'
import listItems from "../components/list-items.vue"

export default {
  name: 'car-page',
  components: {
    MainLayout,
    listItems
  },
  data: () => {
    return {
      minusButtons: document.querySelectorAll(".minus"),
      plusButtons: document.querySelectorAll(".plus"),
      quantityValues: document.querySelectorAll(".quantity"),
      ordenCompra: {
        id: 'NULL',
        persona_id: '',
        listaProductos: [
          {
            producto_id: '',
            precio: 0
          }
        ]
      },
      showSummary: false,
      codigoOrden: '#00000'
    };
  },
  computed: {
    // a computed getter
    calcularCostoTotal() {
      return this.$root.userCart.reduce((costoTotal, producto) => {
        return costoTotal + producto.cantidad * producto.precio;
      }, 0);
    },
    existenItems() {
      return this.$root.userCart.length > 0;
    }
  },
  created: function () {
  },
  methods: {
    register() {
      this.ordenCompra.persona_id = this.$root.userLogged.id;
      this.ordenCompra.listaProductos = this.$root.userCart.map(item => ({ id: item.id, precio: item.precio, cantidad: item.cantidad }));
      console.log('this.ordenCompra', this.ordenCompra);

      this.$root.postData('insertarOrden', this.ordenCompra)
        .then((rs) => {
          this.codigoOrden += rs;
          this.showSummary = true;
          this.$root.userCart = [];
        })
        .catch(function () { })
    },
    decreaseQuantity(producto, index) {
      if (producto.cantidad > 1) {
        producto.cantidad--;
        console.log('producto--', producto)
        this.refreshArray();
      } else {
        this.$root.userCart.splice(index, 1)
      }
    },

    increaseQuantity(producto) {
      producto.cantidad++;
      this.refreshArray();
    },

    refreshArray() {
      this.$root.userCart = [...this.$root.userCart]
    }
  }
}
</script>

<style scoped>
@import '../assets/css/bootstrap.min.css';

.background {
  margin: 2rem 8rem;
}

* {
  box-sizing: border-box;
}


header {
  color: rgb(234, 53, 84);
  padding: 20px;
}

header h1 {
  margin: 0;
  font-size: 1rem;
}

main {
  padding: 20px;
}

#cart-items {
  border-bottom: 1px solid lightgray;
  margin-bottom: 20px;
  padding-bottom: 20px;
}

#cart-items h2 {
  font-size: 24px;
  margin-top: 0;
}

#cart-items ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

#cart-items li {
  align-items: center;
  display: flex;
  margin-bottom: 20px;
}

.item-details {
  flex: 2;
  margin-right: 20px;
}

.item-details h3 {
  margin: 0;
}

.item-details p {
  margin: 0;
}

.item-quantity {
  align-items: center;
  display: flex;
  flex: 1;
  justify-content: right;
}

.quantity-button {
  background-color: rgb(234, 53, 84);
  border: none;
  color: white;
  cursor: pointer;
  font-size: 18px;
  height: 30px;
  margin-right: 5px;
  width: 30px;
}

.quantity {
  margin: 0 5px;
}



#summary {
  display: flex;
  flex-direction: column;
  align-items: center;
}

#summary h2 {
  font-size: 24px;
  margin-bottom: 20px;
}

#summary-details {
  border: 1px solid lightgray;
  margin-bottom: 20px;
  padding: 10px;
  text-align: center;
  width: 200px;
}

#summary-details p {
  margin: 0;
}



.product {
  display: flex;
  align-items: center;
}

.item-image {
  flex: 1;
  height: 100px;
  width: 100px;
  margin-right: 1rem;
}
</style>