@if ($errors->any())
    <div id="toast-container" class="toast-top-right">
        <div class="toast toast-error" aria-live="assertive" style="">
            <div class="toast-title">Предупреждение</div>
{{--            @foreach ($errors->all() as $error)--}}
{{--                <div class="toast-message">{{ $error }}</div>--}}
{{--            @endforeach--}}
            <div class="toast-message">{{ $errors->all()[0] }}</div>
        </div>
    </div>
@endif

@if(session('success'))
    <div id="toast-container" class="toast-top-right">
        <div class="toast toast-success" aria-live="assertive" style="">
            <div class="toast-title">Уведомление</div>
            <div class="toast-message">{{ session('success') }}</div>
        </div>
    </div>
@endif

@if(session('result'))
    <div id="toast-container" class="toast-top-right">
        <div class="toast toast-success" aria-live="assertive" style="">
            <div class="toast-title">Уведомление</div>
            <div class="toast-message">{{ session('result') }}</div>
        </div>
    </div>
@endif

@push('scripts')
    <script>
        $(document).ready(function() {
            // Show notification
            $('#toast-container').fadeIn(800);
            setTimeout(() => {
                $('#toast-container').fadeOut(800);
            }, 5000);
        })
    </script>
@endpush
