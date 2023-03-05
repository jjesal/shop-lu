<template>
  <div id="app">
    <main-layout>
      <div class="background">
        <register-person class="register" :rolId="3">
        </register-person>
      </div>
    </main-layout>
  </div>
</template>

<script>
import MainLayout from '../layouts/main-layout.vue'
import RegisterPerson from '../components/register-person.vue'

export default {
  name: 'register-page',
  components: {
    MainLayout,
    RegisterPerson
  },
  data: () => {
    return {
    };
  },
  created: function () {
  },
  methods: {

  }
}
</script>

<style scoped>
.background {
  background-color: rgb(234, 53, 84);
  color: white;
  height: 100vh;
  width: 100vw;
  margin: 0;
  display: grid;
}

form {
  width: 400px;
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

.register >>> .my-btn {
  --my-btn-color: white;
  --my-text-color: rgb(234, 53, 84);
  margin: 0 30px;
}
</style>