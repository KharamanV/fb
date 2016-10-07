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
                Название:
                <input type="text" name="name" value="{{ $tag->name }}">
            </label>
            <label>
                Slug:
                <input type="text" name="slug" value="{{ $tag->slug }}">
            </label>
            <select name="category_id">
                <option value="">Без категории</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ ($tag->category_id == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <label>
                Описание:
                <textarea name="description">{{ $tag->description }}</textarea>
            </label>
            <button type="submit">OK</button>
        </form>
    </div>
@endsection