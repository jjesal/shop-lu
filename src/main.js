import Vue from 'vue'
// import App from './App.vue'
import routes from './routes'

const app = new Vue({
  data: {
    currentRoute: window.location.pathname
  },
  computed: {
    ViewComponent () {
      const matchingView = routes[this.currentRoute]
      return matchingView
        ? require('./pages/' + matchingView + '.vue').default
        : require('./pages/not-found.vue').default
    }
  },
  render (h) {
    return h(this.ViewComponent)
  }
}).$mount('#app');

window.addEventListener('popstate', () => {
  app.currentRoute = window.location.pathname
})
