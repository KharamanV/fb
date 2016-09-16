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
                <input type="text" name="title">
            </label>
            <label>
                Slug: <br>
                <input type="slug" name="slug">
            </label>
            <label>
                Short: <br>
                <input type="short" name="short">
            </label>
            <label>
                Text: <br>
                <textarea name="text"></textarea>
            </label>
            <label>
                Image: <br>
                <input type="file" name="img">
            </label>
            <button type="submit">OK</button>
        </form>
    </div>
@endsection