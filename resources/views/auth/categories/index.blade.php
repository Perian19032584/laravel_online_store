@extends('auth.template.master')

@section('title', 'Категории')

@section('content')
    <div class="col-md-12">
        <h1>Категории</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>#</th>
                <th>Код</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->code }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('categories.show', $category->id) }}">Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('categories.edit', $category->id)}}">Редактировать</a>
                                <input class="btn btn-danger" type="submit" value="Удалить">
                                @method('DELETE')
                                @csrf
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
        <a class="btn btn-success" type="button" href="{{ route('categories.create') }}">Добавить категорию</a>
    </div>
@endsection
