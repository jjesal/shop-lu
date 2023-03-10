import Vue from 'vue'
// import App from './App.vue'
import routes from './routes'
/* eslint-disable */
// document.pathdev = "http://192.168.1.77:8081";
// document.pathdev = "http://localhost:9090";
document.pathdev = "http://localhost/shop-lu/public";
const app = new Vue({
  data: {
    currentRoute: window.location.pathname,
    loadingPetition: false,
    userCart:[],
    userLogged: {
      rol_id:3
    }
  },
  computed: {
    ViewComponent() {
      const matchingView = routes[this.currentRoute]
      return matchingView
        ? require('./pages/' + matchingView + '.vue').default
        : require('./pages/not-found.vue').default
    }
  },
  render(h) {
    return h(this.ViewComponent)
  },
  mounted() {
    this.isLogged();
  },
  methods: {
    getData(op, spinner = true) {
      this.$root.loadingPetition = spinner;
      return new Promise((resolve, reject) => {
        fetch(document.pathdev + "/php/mainController.php?op=" + op, {
          method: 'GET',
          credentials: 'include'
          /* headers: {'Content-Type': 'application/json' }*/
        }).then(rs => rs.json()).then(response => {
          if (response.hasOwnProperty('connected') && !response.connected) {
            this.navigate('login');
          }
          resolve(response);
        }).catch(e => reject(e)).finally(() => {
          this.$root.loadingPetition = false;
        });
      });
    },
    postData(op, body, typeData = 'json', spinner = true) {
      this.$root.loadingPetition = spinner;
      return new Promise((resolve, reject) => {
        fetch(document.pathdev + "/php/mainController.php?op=" + op, {
          method: 'POST',
          ...(typeData === 'json' ? {
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            }
          } : {}),
          credentials: 'include',
          body: typeData === 'json' ? JSON.stringify(body) : body
        }).then(rs => rs.json()).then(response => {
          if (response.hasOwnProperty('connected') && !response.connected) {
            this.navigate('login');
          } else {
            resolve(response.data||response);
          }
        }).catch(e => reject(e)).finally(() => {
          this.$root.loadingPetition = false;
        });;
      });
    },
    navigate(path) {
      history.pushState(null, "", path);
      this.currentRoute = '/' + path;
    },
    isLogged() {
      this.$root.getData('isLoggedIn')
        .then((response) => {
          if (response.hasOwnProperty('connected') && response.connected) {
            if (this.currentRoute === '/login' || this.currentRoute === '/') {
              this.navigate('home');
            }
            this.$root.userLogged = response;
          } else {
            this.navigate('login');
          }
        })
        .catch(function () { })
    },
  },
}).$mount('#app');

window.addEventListener('popstate', () => {
  app.currentRoute = window.location.pathname
  console.log('app.currentRoute', app.currentRoute);
})
