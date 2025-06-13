@extends('layouts.main')

@php
    // Ustaw tytuł strony (będzie użyty w meta tagach SEO)
    $title = 'Strona główna';
@endphp

@section('content')
    @include('components.hero.section', [
        'title' => $heroSettings->title ?? config('app.name'),
        'description' => $heroSettings->description ?? 'Fullstack Developer z pasją...',
        'primaryButtonText' => $heroSettings->primary_button_text ?? 'Zobacz projekty',
        'primaryButtonUrl' => $heroSettings->primary_button_url ?? '#portfolio',
        'secondaryButtonText' => $heroSettings->secondary_button_text ?? 'Skontaktuj się',
        'secondaryButtonUrl' => $heroSettings->secondary_button_url ?? '#kontakt'
    ])
    
    @include('layouts.about')
@endsection

@section('contact')
    @include('layouts.contact')
@endsection
