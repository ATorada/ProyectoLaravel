@extends('layout')

@section('title', 'Página principal')

@section('content')
    <div class="content">
        <h1>Zombie Eradication Operations</h1>
        <p>
            En la actualidad, la humanidad se enfrenta a una amenaza doblemente peligrosa:
            una misteriosa fuerza alienígena conocida como "las Arqueas" ha generado una plaga zombi que se extiende rápidamente por todo el mundo.
            Para hacer frente a esta situación, se han creado varias unidades especiales de operaciones, cada una con objetivos y capacidades específicas.
            Cada unidad está compuesta por individuos altamente capacitados, con habilidades y equipo especializados para combatir tanto a los zombis como
            a la fuerza alienígena.
        <br> <br>
            Pero los escuadrones no pueden hacerlo todo solos: se necesita la colaboración de todos para hacer frente a esta amenaza.
            Por eso, se invita a todas las personas que están leyendo este texto a unirse al proyecto y participar junto a estos equipos para acabar con la amenaza.
            Juntos podemos hacer la diferencia y garantizar la supervivencia de la humanidad en un mundo cada vez más peligroso. ¡Únete a nosotros!
        </p>
        <div class="img_portada">
            <img src="{{ asset('img/inicio.png') }}" alt="Imagen Principal">
        </div>
    </div>
@endsection
