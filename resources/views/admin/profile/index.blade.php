@extends('admin.base')

@section('title', 'Профиль')

@section('subtitle', 'Профиль админа')

@section('icon', 'pe-7s-user')

@section('active-profile', 'mm-active')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">{{ Auth::user()->full_name }}</h5>
                    <h6 class="card-subtitle">{{ Auth::user()->email }}</h6>
                    <div>
                        <button class="btn btn-primary" onclick="location.href='{{ route('admin.profile.edit') }}'">Редактировать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- Scripts --}}
    <script>

    </script>
@endpush
