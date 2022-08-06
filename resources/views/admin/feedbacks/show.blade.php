@extends('admin.base')

@section('title', 'Отзывы')

@section('subtitle', 'Данные отзыва')

@section('icon', 'pe-7s-ribbon')

@section('active-feedbacks', 'mm-active')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Отзыв №{{ $feedback->id }}</h5>
                    <h6 class="card-subtitle">Дата создания - {{ $feedback->created_at }}</h6>
                    <p><b>Пользователь:</b> <a href="{{ route('admin.users.show', ['user' => $feedback->user->id]) }}">{{ $feedback->user->full_name }}</a></p>
                    <p><b>Заказ:</b> <a href="{{ route('admin.orders.show', ['order' => $feedback->order->id]) }}">№{{ $feedback->order->id }} ({{ $feedback->order->created_at }})</a></p>
                    @if ($feedback->order->courier()->exists())
                        <p><b>Курьер:</b> <a href="{{ route('admin.couriers.show', ['courier' => $feedback->order->courier->id]) }}">{{ $feedback->order->courier->full_name . ' (' . $feedback->order->courier->number . ')' }}</a></p>
                    @else
                        <p><b>Курьер:</b> -</p>
                    @endif
                    <p><b>Оценка:</b> {{ $feedback->rating ?? '-' }}</p>
                    <p><b>Сообщение:</b> {{ $feedback->message ?? '-' }}</p>
                    <div class="fc-rtl">
                        <button class="btn btn-primary" onclick="location.href='{{ route('admin.orders') }}'">Назад в список</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
