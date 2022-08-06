@extends('admin.base')

@section('title', 'Показатели')

@section('subtitle', 'Статистика сайта')

@section('icon', 'pe-7s-graph2')

@section('active-main', 'mm-active')

@section('content')
<div class="row">
    <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-midnight-bloom">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Пользователи</div>
                    <div class="widget-subheading">Количество пользователей</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{ $totalUsers }}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-arielle-smile">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Курьеры</div>
                    <div class="widget-subheading">Количество курьеров</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{ $totalCouriers }}</span></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-grow-early">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Заказы</div>
                    <div class="widget-subheading">Количество заказов</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-white"><span>{{ $totalOrders }}</span></div>
                </div>
            </div>
        </div>
    </div>
     <div class="col-md-6 col-xl-4">
        <div class="card mb-3 widget-content bg-premium-dark">
            <div class="widget-content-wrapper text-white">
                <div class="widget-content-left">
                    <div class="widget-heading">Отзывы</div>
                    <div class="widget-subheading">Количество отзывов</div>
                </div>
                <div class="widget-content-right">
                    <div class="widget-numbers text-warning"><span>{{ $totalFeedbacks }}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
