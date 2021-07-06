@extends('layouts.default')

@section('content')

    <div class="container-fluid home-hero">
        <div class="filter-black">
            <div class="container">
                <h1 class="title-hero"><span>Bienvenue à </span>MONTAULIEU</h1>
                <a href="" class="button-all button-accent">Voir l ' Agenda</a>
            </div>
        </div>
    </div>
    <div class="container-fluid  p-0 home-about">
            <section class="home-about-textbox ">
                <h2 class="text-center title-2">Notre commune</h2>
                <p class="mt-2">...vous accueille au coeur de la <strong>Drome Provencale</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci amet beatae cum, deserunt dolorem eaque harum magnam modi nisi officia optio quia quisquam rem. Expedita fugiat illum perferendis praesentium sunt!</p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium deserunt distinctio et facere quas, quidem temporibus voluptatum! Distinctio, dolor, labore? Adipisci dolore ea exercitationem hic, necessitatibus provident quas ut vel?</p>
            </section>
    </div>
    <div class="home-actu">
        <h2 class="title-3">Dernières actualités</h2>
        <a href="" class="button-all">TOUTE l'actu</a>
    </div>
    <div class="home-agenda">
        <h2 class="title-2">Agenda</h2>
             <div class="owl-carousel owl-theme">
                <div class="item" style="background-image: url('/storage/uploads/elements/images/agenda-img.jpg');">
                    <div class="filter-agenda">
                        <h3>Titre</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A, aspernatur consequatur eligendi fugit iusto minus quia quos saepe. </p>
                        <a href="" class="button-all button-agenda">Voir Plus</a>
                    </div>

                </div>
                <div class="item">
                    <h3>2</h3>
                </div>
                <div class="item">
                    <h3>3</h3>
                </div>
           </div>

        <a href="" class="button-all button-accent">TOUT l'agenda</a>
    </div>
@endsection
