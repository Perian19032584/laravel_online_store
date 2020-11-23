@extends('template.template')
@section('title', "Все категории")
@section('content')
    @foreach($categories as $category)
<div class="container">
    <div class="starter-template">
        <div class="panel">
            <a href="{{ route('category', $category->code) }}">
                <img src="{{ Storage::url($category->image) }}">
                <h2>{{ $category->name }}</h2>
            </a>
            <p>{{$category->description}}</p>
        </div>
    </div>
</div>
    @endforeach
@endsection
