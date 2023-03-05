<template>
  <div id="app">
    <main-layout>
      <div class="background">
        <div class="main-form form-group my-mg-auto-x">
          <label>Mis pedidos</label>
          <br><br>
          <list-items @evt-ver-productos="showModal" :arrItems="arrOrdenes"
            :arrHeadKey="arrHeadKey" :arrButtons="arrButtons"></list-items>
        </div>
      </div>

      <div id="modal">
        <div id="modal-content">
          <h2>Lista de productos</h2>
          <br><br>
          <list-items :arrItems="arrProductos" :arrHeadKey="arrHeadKeyProducts" :arrButtons="[]"></list-items>
          <button id="close-modal">Cerrar</button>
        </div>
      </div>


    </main-layout>
  </div>
</template>

<script>
import MainLayout from '../layouts/main-layout.vue'
import listItems from "../components/list-items.vue"
import swal from 'sweetalert2';

export default {
  name: 'list-user-orders',
  components: {
    MainLayout,
    listItems,
    swal
  },
  data: () => {
    return {
      arrOrdenes: [],
      arrProductos: [],
      arrHeadKey: [{ head: 'Cod. Orden', key: 'id_show' }, { head: 'Costo total', key: 'costo_total', computeFx: (orden) => 'S/. ' + parseFloat(orden.costo_total).toFixed(2) },
      { head: 'Fecha de compra', key: 'fecha_compra' },
      { head: 'Estado', key: 'estado', computeFx: orden => orden.estado === 'Entregado' ? `${orden.estado} (${orden.fecha_ejecucion})` : orden.estado }
      ],
      arrHeadKeyProducts: [
        { head: 'Producto', key: 'nombre_producto' }, { head: 'Categoria', key: 'nombre_categoria' }, { head: 'Marca', key: 'nombre_marca' },
        { head: 'Precio', key: 'precio' }, { head: 'Cantidad', key: 'cantidad' },
      ],
      arrButtons: [
        { name: 'Ver Productos', event: 'evt-ver-productos' }
      ],
      operadorFiltrado: '=',
      campo: 'orden_compra.persona_id',
      valor: 'categoria.id',

    };
  },
  mounted: function () {
    this.listarPorUsuario();
    window.onclick = function (event) {
      if (event.target.id == "modal") {
        document.getElementById("modal").style.display = "none";
      }
    }
    document.getElementById("close-modal").onclick = function () {
      document.getElementById("modal").style.display = "none";
    }
  },
  methods: {
    showModal(index) {
      document.getElementById("modal").style.display = "block";
      this.arrProductos = this.arrOrdenes[index].productos
    },
    listarPorUsuario() {
      const condiciones = {
        campo: this.campo,
        operador: this.operadorFiltrado,
        valor: this.$root.userLogged.id
      };
      this.getList(condiciones);
    },
    getList(condiciones = {}) {
      this.$root.postData('listarOrden', condiciones).then(arrOrdenes => {
        this.arrOrdenes = arrOrdenes;
      });
    },
    updateOrderState(orden) {
      this.$root.postData('actualizarEstado', orden)
        .then(() => {
          swal.fire({
            position: 'bottom-end',
            icon: 'success',
            title: 'Orden actualizada',
            showConfirmButton: false,
            timer: 750,
          })
          this.getList();
        })
    },
    mostrarProductos() {

    },
    openModal() {
      document.getElementById("myModal").style.display = "block";
    },
    closeModal() {
      document.getElementById("myModal").style.display = "none";
    }

  }
}
</script>

<style scoped>
@import '../assets/css/bootstrap.min.css';

.background {
  height: 100vh;
  margin: 0;
}

.main-form {
  margin-top: 2rem;
  width: 60%;
  gap: 1rem;
  font-size: 1.2rem;
}

.main-form>label {
  font-size: 45px;
}

.my-btn {
  margin: 0 auto;
  display: block;
}

#modal {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

#modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  border-radius: 10px;
  width: 80%;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {
    transform: scale(0);
  }

  to {
    transform: scale(1);
  }
}

#close-modal {
  float: right;
  margin-top: -10px;
  margin-right: -10px;
  background-color: #fff;
  border: none;
  color: #000;
  cursor: pointer;
  border-radius: 5px;
  padding: 5px;
}

#close-modal:hover {
  background-color: #000;
  color: #fff;
}
</style>