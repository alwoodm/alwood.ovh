@extends('layouts.main')

@section('title', 'Strona główna')

@section('content')
    
@endsection

@section('contact')
    @include('components.contact-section')
@endsection

@if (Route::has('login'))
    <div class="h-14.5 hidden lg:block"></div>
@endif
</body>
</html>
