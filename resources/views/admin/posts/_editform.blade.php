@php
    $posted_at = old('posted_at') ?? (isset($post) ? $post->posted_at->format('Y-m-d\TH:i') : null);
@endphp

<div class="form-group">
    {!! Form::label('title', __('posts.attributes.title')) !!}
    {!! Form::text('title', null, ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'required']) !!}

    @error('title')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
<!-- <div class="form-group">
    {!! Form::label('categories', __('posts.attributes.categories')) !!}
    {!! Form::select('categories[]', $categories, [old('categories') ? old('categories') : $post->categories->pluck('id')->toArray()], ['placeholder' => __('posts.placeholder.categories'), 'class' => 'form-control' . ($errors->has('categories') ? ' is-invalid' : ''), 'multiple' => 'multiple']) !!}

    @error('categories')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div> -->
<div class="form-group">
    {!! Form::label('categories', __('posts.attributes.categories')) !!}
    <select name="categories[]" id="categories" class="selectpicker" multiple>
        @foreach ($categories as $id => $tdrop) 
            @if (old('categories'))
                <option value="{{ $id }}" {{ in_array($id, old('categories[]')) ? 'selected' : '' }}>{{ $tdrop }}</option>   
            @else
                <option value="{{ $id }}" {{ $post->categories->contains($id) ? 'selected' : '' }}>{{ $tdrop }}</option>
            @endif 
        @endforeach
    </select>
</div>
<div class="form-group">
    {!! Form::label('description', __('posts.attributes.description')) !!}
    {!! Form::text('description', null, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'required']) !!}

    @error('description')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('author_id', __('posts.attributes.author')) !!}
        {!! Form::select('author_id', $users, null, ['class' => 'form-control' . ($errors->has('author_id') ? ' is-invalid' : ''), 'required']) !!}

        @error('author_id')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('posted_at', __('posts.attributes.posted_at')) !!}
        <input type="datetime-local" name="posted_at" class="form-control {{ ($errors->has('posted_at') ? ' is-invalid' : '') }}" required value="{{ $posted_at }}">

        @error('posted_at')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>

<div class="form-group">
    {!! Form::label('thumbnail_id', __('posts.attributes.thumbnail')) !!}
    {!! Form::select('thumbnail_id', $media, null, ['placeholder' => __('posts.placeholder.thumbnail'), 'class' => 'form-control' . ($errors->has('thumbnail_id') ? ' is-invalid' : '')]) !!}

    @error('thumbnail_id')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>


<div class="form-group">
    {!! Form::label('content', __('posts.attributes.content')) !!}
    {!! Form::textarea('content', null, ['class' => 'form-control trumbowyg-form' . ($errors->has('content') ? ' is-invalid' : ''), 'required']) !!}

    @error('content')
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
