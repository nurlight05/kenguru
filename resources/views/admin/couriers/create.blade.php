@extends('admin.base')

@section('title', 'Курьеры')

@section('subtitle', 'Добавить курьера')

@section('icon', 'pe-7s-smile')

@section('active-couriers', 'mm-active')

@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body"><h5 class="card-title">Добавить курьера</h5>
            <form class="" action="{{ route('admin.couriers.store') }}" method="POST">
                @csrf
                <div class="position-relative row form-group">
                    <label for="firstname" class="col-sm-2 col-form-label">Имя</label>
                    <div class="col-sm-10">
                        <input name="firstname" id="firstname" placeholder="Введите имя" type="text" class="form-control" value="{{ old('firstname') ?? '' }}" required>
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label for="lastname" class="col-sm-2 col-form-label">Фамилия</label>
                    <div class="col-sm-10">
                        <input name="lastname" id="lastname" placeholder="Введите фамилию" type="text" class="form-control" value="{{ old('lastname') ?? '' }}" required>
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label for="iin" class="col-sm-2 col-form-label">ИИН</label>
                    <div class="col-sm-10">
                        <input name="iin" id="iin" placeholder="Введите ИИН" type="text" class="form-control" value="{{ old('iin') ?? '' }}" required>
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input name="email" id="email" placeholder="Введите почту" type="text" class="form-control" value="{{ old('email') ?? '' }}" required>
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label for="number" class="col-sm-2 col-form-label">Номер телефона</label>
                    <div class="col-sm-10">
                        <input name="number" id="number" placeholder="Введите номер телефона" type="text" class="form-control" value="{{ old('number') ?? '' }}" required>
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label for="password" class="col-sm-2 col-form-label">Пароль</label>
                    <div class="col-sm-10">
                        <input name="password" id="password" placeholder="Введите новый пароль" type="password" class="form-control" required>
                    </div>
                </div>
                <div class="position-relative row form-group">
                    <label for="password2" class="col-sm-2 col-form-label">Повторите пароль</label>
                    <div class="col-sm-10">
                        <input name="password2" id="password2" placeholder="Повторно введите пароль" type="password" class="form-control" required>
                    </div>
                </div>
                <div class="position-relative row form-check">
                    <div class="col-sm-10 offset-sm-2 pl-0">
                        <button class="btn btn-success" type="submit">Добавить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
