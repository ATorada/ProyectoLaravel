@extends('layout')

@section('title', 'Página principal')

@section('content')
    <div class="content">
        <h1>Asociación</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquam accusamus nesciunt velit quia perspiciatis
            beatae! Reprehenderit tenetur quasi sint soluta ut quo doloribus iure ipsum laborum aliquid. Doloribus, eos
            tenetur?</p>
        <div class="img_portada">
            <img src="{{ asset('img/inicio.png') }}" alt="Imagen Principal">
        </div>
    </div>
@endsection
