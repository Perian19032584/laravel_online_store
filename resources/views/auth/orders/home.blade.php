@extends('auth.template.master')
@section('title', 'Заказы')
@section('content')


    <div class="col-md-12">
        <h1>Заказы</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>#</th>
                <th>Имя</th>
                <th>Телефон</th>
                <th>Когда отправлен</th>
                <th>Сумма</th>
                <th>Действия</th>
            </tr>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->name }}</td>
                <td>{{ $order->phone }}</td>
                <td>{{ $order->created_at->format('H:i:s d/m/Y')}}</td>
                <td>123</td>
                <td>
                    <div class="btn-group" role="group">
                        @admin
                            <a class="btn btn-success" type="button" href="{{ route('orders.show', $order->id) }}">Открыть</a>
                        @else
                            <a class="btn btn-success" type="button" href="{{ route('person.orders.show', $order->id) }}">Открыть</a>
                        @endadmin
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
@endsection
