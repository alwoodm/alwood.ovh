@extends('layouts.main')

@section('title', 'Strona główna')

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
