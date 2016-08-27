@extends('layouts.app')

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
        <form action="{{ route('post.store') }}" method="post">
            {{ csrf_field() }}
            <label>
                Title: <br>
                <input type="text" name="title">
            </label>
            <label>
                Short: <br>
                <input type="short" name="short">
            </label>
            <label>
                Slug: <br>
                <input type="slug" name="slug">
            </label>
            <label>
                Text: <br>
                <textarea name="text"></textarea>
            </label>
            <button type="submit">OK</button>
        </form>
    </div>
@endsection