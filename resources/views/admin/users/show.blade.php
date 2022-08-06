@extends('admin.base')

@section('title', 'Пользователи')

@section('subtitle', 'Данные пользователя')

@section('icon', 'pe-7s-users')

@section('active-users', 'mm-active')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->full_name }}</h5>
                    <h6 class="card-subtitle">Email - {{ $user->email }}</h6>
                    <p><b>Дата рождения:</b> {{ $user->birthday }}</p>
                    <p><b>Номер телефона:</b> {{ $user->phone }}</p>
                    <p><b>Заказы данного пользователя:</b></p>
                    <div>
                        <ol>
                            @forelse ($user->orders as $item)
                                <li>№{{ $item->id }} ({{ $item->created_at }})</li>
                            @empty
                                Отсутствует
                            @endforelse
                        </ol>
                    </div>
                    <div class="fc-rtl">
                        <button class="btn btn-primary" onclick="location.href='{{ route('admin.users') }}'">Назад в список</button>
                        <button class="btn btn-primary" onclick="location.href='{{ route('admin.users.reset-password', ['user' => $user->id]) }}'">Сброс пароля</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
