@extends('admin.base')

@section('title', 'Заказы')

@section('subtitle', 'Данные заказа')

@section('icon', 'pe-7s-shopbag')

@section('active-orders', 'mm-active')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Заказ №{{ $order->id }}</h5>
                    <h6 class="card-subtitle">Дата создания - {{ $order->created_at }}</h6>
                    @if ($order->courier()->exists())
                        <p><b>Курьер:</b> <a href="{{ route('admin.couriers.show', ['courier' => $order->courier->id]) }}">{{ $order->courier->full_name . ' (' . $order->courier->number . ')' }}</a></p>
                    @else
                        <p><b>Курьер:</b> -</p>
                    @endif
                    <p><b>Сумма:</b> {{ $order->sum_to_pay ?? '-' }} тг.</p>
                    <p><b>Откуда:</b></p>
                    <div class="pl-5">
                        <p><b>Улица: </b> {{ $order->from_street ?? '-' }}</p>
                        <p><b>Здание: </b> {{ $order->from_building ?? '-' }}</p>
                        <p><b>Этаж: </b> {{ $order->from_floor ?? '-' }}</p>
                        <p><b>Квартира: </b> {{ $order->from_room_number ?? '-' }}</p>
                        <p><b>Интерком: </b> {{ $order->from_intercom ?? '-' }}</p>
                        <p><b>Долгота: </b> {{ $order->from_long ?? '-' }}</p>
                        <p><b>Широта: </b> {{ $order->from_lat ?? '-' }}</p>
                    </div>
                    <p><b>Куда:</b></p>
                    <div class="pl-5">
                        <p><b>Улица: </b> {{ $order->to_street ?? '-' }}</p>
                        <p><b>Здание: </b> {{ $order->to_building ?? '-' }}</p>
                        <p><b>Этаж: </b> {{ $order->to_floor ?? '-' }}</p>
                        <p><b>Квартира: </b> {{ $order->to_room_number ?? '-' }}</p>
                        <p><b>Интерком: </b> {{ $order->to_intercom ?? '-' }}</p>
                        <p><b>Долгота: </b> {{ $order->to_long ?? '-' }}</p>
                        <p><b>Широта: </b> {{ $order->to_lat ?? '-' }}</p>
                    </div>
                    <p><b>Тип транспорта:</b> {{ $order->vehicle_type ?? '-' }}</p>
                    <div class="fc-rtl">
                        <button class="btn btn-primary" onclick="location.href='{{ route('admin.orders') }}'">Назад в список</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
