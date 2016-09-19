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
        <form action="{{ route('tags.update', $tag->id) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <label>
                Категория:
                <input type="text" name="name" value="{{ $tag->name }}">
            </label>
            <label>
                Описание:
                <input type="text" name="description" value="{{ $tag->description }}">
            </label>
            <button type="submit">OK</button>
        </form>
    </div>
@endsection