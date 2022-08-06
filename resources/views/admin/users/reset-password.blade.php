@extends('admin.base')

@section('title', 'Пользователь - ' . $user->full_name)

@section('subtitle', 'Данные пользователя')

@section('icon', 'pe-7s-users')

@section('active-users', 'mm-active')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Сброс пароля</h5>
            <form class="" action="{{ route('admin.users.reset-password.submit', ['user' => $user->id]) }}" method="POST">
                @csrf
                <div class="position-relative row form-group">
                    <label for="password" class="col-sm-2 col-form-label">Новый пароль</label>
                    <div class="col-sm-10">
                        <input name="password" id="password" placeholder="Введите новый пароль" type="password" class="form-control" required>
                    </div>
                </div>
                <div class="position-relative row form-check">
                    <div class="col-sm-10 offset-sm-2 pl-0">
                        <button class="btn btn-success" type="submit">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
