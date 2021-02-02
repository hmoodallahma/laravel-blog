import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
import { setAuthHeadersFromAuthRequest } from './helpers'
import * as config from '../config'

// import { setAuthHeadersFromAuthRequest, setAuthHeadersFromStorage } from './helpers'

Vue.use(Vuex)

// axios.defaults.xsrfCookieName = 'csrftoken'
// axios.defaults.xsrfHeaderName = 'X-CSRFToken'
// acrossDomain: true

export const store = new Vuex.Store({
  data () {
    return {
      posts: []
    }
  },
  state: {
    
    endpoints: {
      // TODO: Remove hardcoding of dev endpoints
      baseUrl: config.apiDomain,
      getPosts: config.apiPosts,
      getPosts: config.apiSearch,
    }
  },
  mutations: {
    setPosts (state, posts) {
      state.posts = posts
    }
  },
  actions : {
  obtainPosts (context) {
      axios.get(`${this.state.endpoints.getPosts}`)
        .then((response) => {
          console.log(response)
        })
        .catch((error) => {
          console.log(error.response)
          context.errors = error.response
        })
    },
   searchPosts (context) {
      axios.get(`${this.state.endpoints.getPosts}`)
        .then((response) => {
          console.log(response)
        })
        .catch((error) => {
          console.log(error.response)
          context.errors = error.response
        })
      }
  }
  beforeDestroy () {
    window.removeEventListener('resize', this.getWindowWidth)
  },
  mounted () {
    window.addEventListener('resize', this.getWindowWidth)
    this.getWindowWidth()
  }
})
