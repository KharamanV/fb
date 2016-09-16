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
                <input type="text" name="title" value="{{ $post->title }}">
            </label>
            <label>
                Slug: <br>
                <input type="slug" name="slug" value="{{ $post->slug }}">
            </label>
            <label>
                Short: <br>
                <input type="short" name="short" value="{{ $post->short }}">
            </label>
            <label>
                Text: <br>
                <textarea name="text">{{ $post->text }}</textarea>
            </label>
            <label>
                Image: <br>
                <input type="file" name="img">
            </label>
            <button type="submit">OK</button>
        </form>
    </div>
@endsection