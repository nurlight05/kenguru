@extends('admin.base')

@section('title', 'Курьеры')

@section('subtitle', 'Данные курьера')

@section('icon', 'pe-7s-smile')

@section('active-couriers', 'mm-active')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">{{ $courier->full_name }}</h5>
                    <h6 class="card-subtitle">Email - {{ $courier->email ?? 'Отсутствует' }}</h6>
                    <p><b>ИИН:</b> {{ $courier->iin }}</p>
                    <p><b>Номер телефона:</b> {{ $courier->number }}</p>
                    <p><b>Рейтинг:</b> <i class="pe-7s-star"></i> {{ $courier->rating ?? '-' }}</p>
                    <div class="fc-rtl">
                        <button class="btn btn-primary" onclick="location.href='{{ route('admin.couriers') }}'">Назад в список</button>
                        <button class="btn btn-primary" onclick="location.href='{{ route('admin.couriers.edit', ['courier' => $courier->id]) }}'">Редактировать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
