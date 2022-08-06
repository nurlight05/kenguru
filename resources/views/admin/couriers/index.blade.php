@extends('admin.base')

@section('title', 'Курьеры')

@section('subtitle', 'Все курьеры')

@section('icon', 'pe-7s-smile')

@section('active-couriers', 'mm-active')

@section('content')
    <div class="">
        <div class="row align-items-stretch">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        <form action="{{ route('admin.couriers') }}" method="GET">
                            <div class="input-group">
                                <input id="input-kaspi" type="text" name="query" class="form-control" value="{{ request()->input('query') ?? '' }}" placeholder="Введите текст для поиска...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary">
                                        <i class="pe-7s-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 search-result">
                <div class="main-card mb-3 card">
                    <div class="card-body">
                        Найдено курьеров: {{ $couriers->total() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <form action="{{ route('admin.couriers.submit') }}" method="post">
                        @csrf
                        <div class="card-header">
                            Все курьеры
                            {{-- <div class="btn-actions-pane-right">
                                <button class="btn btn-success" type="button" style="padding: .25rem .5rem; font-size: .875rem;" onclick="location.href='{{ route('admin.couriers.create') }}'">Добавить</button>
                            </div> --}}
                        </div>
                        <div class="table-responsive">
                            <table class="align-middle mb-0 table table-borderless table-hover sortable">
                                <thead>
                                <tr>
                                    <th class="text-center sorttable_nosort">
                                        <input class="cursor-pointer" type="checkbox" name="" id="selectAll">
                                    </th>
                                    <th class="cursor-pointer u-select-none">Имя</th>
                                    <th class="cursor-pointer u-select-none">ИИН</th>
                                    <th class="cursor-pointer u-select-none">Email</th>
                                    <th class="cursor-pointer u-select-none">Номер телефона</th>
                                    <th class="text-center u-select-none sorttable_nosort">Действия</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($couriers as $item)
                                    <tr>
                                        <td class="text-center">
                                            <input class="cursor-pointer" type="checkbox" name="couriers[]" value="{{ $item->id }}" id="">
                                        </td>
                                        <td>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left flex2">
                                                        <div class="widget-heading">{{ $item->full_name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $item->iin }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->number }}</td>
                                        <td class="text-center nowrap">
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-warning btn-sm" onclick="location.href='{{ route('admin.couriers.show', ['courier' => $item->id]) }}'" title="Просмотр">
                                                <i class="pe-7s-next-2"></i>
                                            </button>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm" onclick="location.href='{{ route('admin.couriers.edit', ['courier' => $item->id]) }}'" title="Редактировать">
                                                <i class="pe-7s-pen"></i>
                                            </button>
                                            <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm" onclick="location.href='{{ route('admin.couriers.delete', ['courier' => $item->id]) }}'" title="Удалить">
                                                <i class="pe-7s-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Пока здесь ничего нет</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <img class="mr-2 mb-2" src="{{ asset('/assets/admin/images/curve-thin-up-arrow.svg') }}" alt="" width="16px" height="16px">
                            <div class="dropdown d-inline-block">
                                <div class="dropright btn-group">
                                    <button class="btn-wide btn btn-primary" type="button">С отмеченными:</button>
                                    <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle-split dropdown-toggle btn btn-primary"><span class="sr-only">Toggle Dropdown</span></button>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                                        <button type="submit" name="action" value="delete" tabindex="0" class="dropdown-item btn-outline-danger" disabled>Удалить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-actions-pane-right">
                                {!! $couriers->appends(request()->except('page'))->links() !!}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .search-result .card{
            height: calc(100% - 30px);
        }

        .search-result .card-body {
            display: flex;
            align-items: center;
            font-size: 1rem;
            font-weight: 400;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('#selectAll').click(function(e){
            var table= $(e.target).closest('table');
            $('td input:checkbox', table).not('#not-deletable').prop('checked',this.checked);
        });
    </script>
@endpush
