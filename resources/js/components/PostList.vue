<template>
  <div>
    <post
      v-for="post in posts"
      :key="post.id"
      :post="post"
    />


  </div>
</template>

<script>

import Post from './Post'
import { mapState, mapActions } from 'vuex'

export default {
  components: { Post },

  data () {
    return {
      posts: [],
      
    }
  },

  mounted () {
    this.retrievePosts()

  },

  methods: {
    ...mapActions({
      retrieve_posts: 'obtainPosts',
      search_posts: 'searchPosts'
    }),
    retrievePosts () {
      this.retrieve_posts()
    },
    searchPosts () {
      this.search_posts()
    },

    
  }
}
</script>
