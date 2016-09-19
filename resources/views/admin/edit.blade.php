@extends('layouts.admin')

@section('content')
    <style>
        input, 
        textarea {
            width: 700px;
        }
        label {
            display: block;
            margin-bottom: 20px;
        }
    </style>
    <div class="container">
        @include('partials._errors')
        <form action="{{ route('admin.update', $post->slug) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <label>
                Title: <br>
                <input type="text" name="title" id="title-field" value="{{ $post->title }}">
            </label>
            <label>
                Slug: <br>
                <input type="slug" name="slug" id="slug-field" value="{{ $post->slug }}">
            </label>
            <label>
                Категория:
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ ($category->id == $post->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
            <label>
                Short: <br>
                <input type="short" name="short" value="{{ $post->short }}">
            </label>
            <label>
                Text: <br>
                <textarea name="text" id="editor">{{ $post->text }}</textarea>
            </label>
            <label>
                Image: <br>
                <input type="file" name="img" id="image-upload">
            </label>
            <img id="image-preview" src="">
            <button type="submit">OK</button>
        </form>
    </div>
@endsection