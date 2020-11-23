@extends('template.template')
@section('title', 'Корзина')
@section('content')
<div class="container">
    <div class="starter-template">
        @if(session()->has('success'))
        <p class="alert alert-success">{{ session()->get('success') }}</p>
        @endif
        @if(session()->has('remove'))
            <p class="alert alert-warning">{{ session()->get('remove') }}</p>
        @endif
        <h1>Корзина</h1>
        <p>Оформление заказа</p>
        <div class="panel">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Название</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Стоимость</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->products as $product)
                <tr>
                    <td>
                        <a href="{{ route('product', array($product->category->code, $product->code)) }}">
                            <img height="56px" src="{{ Storage::url($product->image) }}">
                            {{$product->name}}
                        </a>
                    </td>
                    <td><span class="badge">{{ $product->pivot->count }}</span>
                        <div class="btn-group form-inline">
                            <form action="{{ route('basket_remove', $product->id) }}" method="POST">
                                <button type="submit" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                </button>
                                @csrf
                            </form>

                            <form action="{{ route('basket_add', $product->id) }}" method="POST">
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                @csrf
                            </form>
                        </div>
                    </td>
                    <td>{{ $product->price }}р</td>
                    <td>{{ $product->getPriceForCount($product->pivot->count) }}р</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3">Общая стоимость:</td>
                    <td>{{ $order->calculate($product->pivot->count) }} ₽</td>
                </tr>
                </tbody>
            </table>
            <br>
            <div class="btn-group pull-right" role="group">
                <a type="button" class="btn btn-success" href="{{ route('order') }}">Оформить заказ</a>
            </div>
        </div>
    </div>
</div>

@endsection
