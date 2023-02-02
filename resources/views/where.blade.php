@extends('layout')

@section('title', 'Dónde estamos')

@section('content')
    <div class="content">
        <h1>Dónde estamos</h1>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1379.363527891583!2d135.5116411236218!3d34.687574723795706!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6000e72734200221%3A0x51d17a0547560ef!2sCapcom!5e0!3m2!1ses-419!2ses!4v1675299864899!5m2!1ses-419!2ses"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
@endsection
