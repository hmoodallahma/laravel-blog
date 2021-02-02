@extends('layouts.app')

@section('content')
<p class="mt-3 small">
      {{ link_to_route('home', '< See all posts ' , [], []) }}
    </p>
  <div class="bg-white p-3 post-card">
    @if ($post->hasThumbnail())
      {{ Html::image($post->thumbnail->getUrl(), $post->thumbnail->name, ['class' => 'card-img-top']) }}
    @endif

    <h1 v-pre>{{ $post->title }}</h1>
    
    <div class="mb-3">
      <small v-pre class="text-muted">{{ link_to_route('users.show', $post->author->fullname, $post->author) }}</small>,
      <small class="text-muted">{{ humanize_date($post->posted_at) }}</small>
    </div>
     

    <div v-pre class="post-content">
      {!! $post->content !!}
    </div>

    
  </div>

  @include ('comments/_list')
@endsection
