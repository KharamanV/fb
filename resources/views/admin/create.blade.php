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
        <form action="{{ route('admin.store') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label>
                Title: <br>
                <input type="text" name="title" id="title-field" value="{{ old('title') }}">
            </label>
            <label>
                Slug: <br>
                <input type="slug" name="slug" id="slug-field" value="{{ old('slug') }}">
            </label>
            <label>
                Short: <br>
                <input type="short" name="short" value="{{ old('short') }}">
            </label>
            <label>
                Text: <br>
                <textarea name="text">{{ old('text') }}</textarea>
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