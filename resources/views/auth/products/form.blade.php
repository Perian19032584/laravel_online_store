@extends('auth.template.master')

@section('content')
    <div class="col-md-12">
        @isset($product)
            <h2>Редактирования товара: <b> {{ $product->name }}</b></h2>
        @else
            <h1>Добавить товар</h1>
        @endisset
        <form method="POST" enctype="multipart/form-data" action="@isset($product){{ route('product.update', $product->id) }}@else{{ route('product.store') }}@endisset">
            <div>
                @isset($product)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="code" class="col-sm-2 col-form-label">Код: </label>
                    <div class="col-sm-6">
                        @include('auth.template.error', ['fieldName' => 'code'])
                        <input type="text" class="form-control" name="code" id="code" value="@isset($product){{$product->code}}@endisset">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Название: </label>
                    <div class="col-sm-6">
                        @include('auth.template.error', ['fieldName' => 'name'])
                        <input type="text" class="form-control" name="name" id="name" value="@isset($product){{$product->name}}@endisset">
                    </div>
                </div>
                <br>

                <div class="input-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Категория: </label>
                    <div class="col-sm-6">
                        @include('auth.template.error', ['fieldName' => 'category_id'])
                        <select name="category_id" id="category_id" class="form-control">
                            @isset($category)
                                @foreach($category as $categories)
                                <option value="{{ $categories->id }}">{{ $categories->name }}</option>
                                @endforeach
                            @else
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            @endisset
                        </select>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="description" class="col-sm-2 col-form-label">Описание: </label>
                    <div class="col-sm-6">
                        @include('auth.template.error', ['fieldName' => 'description'])
                        <textarea name="description" id="description" cols="72" rows="7">@isset($product){{$product->description}}@endisset</textarea>
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="price" class="col-sm-2 col-form-label">Цена: </label>
                    <div class="col-sm-6">
                        @include('auth.template.error', ['fieldName' => 'price'])
                        <input type="text" class="form-control" name="price" id="name" value="@isset($product){{$product->price}}@endisset">
                    </div>
                </div>
                <br>
                <div class="input-group row">
                    <label for="image" class="col-sm-2 col-form-label">Картинка: </label>
                    <div class="col-sm-10">
                        <label class="btn btn-default btn-file">
                            Загрузить <input type="file" style="display: none;" name="image" id="image">
                        </label>
                    </div>
                </div>
                <br>
                @foreach(['hit' => 'Хит', 'new' => 'Новинка', 'recommend' => 'Рекомендуемые'] as $field => $title)
                        <div class="form-group row">
                            <label for="code" class="col-sm-2 col-form-label">{{ $title }}: </label>
                            <div class="col-sm-6">
                                <input type="checkbox" class="form-control" name="{{ $field }}" id="{{ $field }}"
                                @if(isset($product) && $product->$field === 1)
                                    checked="checked"
                                @endif>
                            </div>
                        </div>
                @endforeach

                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection
