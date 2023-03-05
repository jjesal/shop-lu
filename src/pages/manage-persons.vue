<template>
  <div id="app">
    <main-layout>
      <div class="background">
        <register-person @evt-reload-list="getList" :showRol="true">
        </register-person>
        <br><br>
        <list-items  :arrItems="arrPersona" :arrHeadKey="arrHeadKey"></list-items>
      </div>
    </main-layout>
  </div>
</template>

<script>
import MainLayout from '../layouts/main-layout.vue'
import RegisterPerson from '../components/register-person.vue'
import listItems from "../components/list-items.vue"

export default {
  name: 'manage-persons',
  components: {
    MainLayout,
    RegisterPerson,
    listItems
  },
  data: () => {
    return {
      arrPersona: [],
      arrHeadKey: [{ head: 'DNI', key: 'dni' }, { head: 'Nombre', key: 'nombre' },{ head: 'Rol', key: 'nombre_rol' },{ head: 'Celular', key: 'celular' },
      { head: 'Correo', key: 'correo' }, { head: 'Dirección', key: 'direccion' }]
    };
  },
  created: function () {
    this.getList();
  },
  methods: {
    getList() {
      this.$root.getData('listarPersona').then(arrPersona => {
        this.arrPersona = arrPersona;
      });
    }
  }
}
</script>

<style scoped>
.background {
  width: 60%;
  margin: auto;
}

form {
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
</style>