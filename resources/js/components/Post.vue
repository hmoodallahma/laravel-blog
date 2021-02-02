<template>
  <div class="card mb-2">
    <div class="card-body">
      <div class="card-title d-flex justify-content-between">
        <h3>
          <a :href="post.title">{{ post.title }}</a>
        </h6>
        <h3>
          <a :href="post.author_url">{{ post.author_name }}</a>
        </h6>

      </div>

      <p class="card-text">
        {{ post.description }}
      </p>
      <p class="card-text">
        <small class="text-muted">{{ post.humanized_posted_at }}</small>
      </p>
    </div>
  </div>
</template>

<script>


export default {
  props: {
    post: {
      type: Object,
      required: true
    }
  }
}
</script>
