@extends('layouts.home')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-success mb-3 animated slideInDown">Sobre Nós</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-success" href="#">Início</a></li>
                    <li class="breadcrumb-item"><a class="text-success" href="#">Páginas</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Sobre</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="d-flex flex-column">
                        <img class="img-fluid rounded w-75 align-self-end" src="{{ asset('home/img/about-1.jpg') }}"
                            alt="">
                        <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="{{ asset('home/img/about-2.jpg') }}"
                            alt="" style="margin-top: -25%;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Sobre nós</p>
                    <h1 class="mb-4">Por que você deve confiar em nós? Conheça mais sobre nós!</h1>
                    <p>Na Green Word, nos dedicamos à prática da medicina ervanária, utilizando o poder das plantas
                        medicinais e remédios naturais para tratar e promover o bem-estar. Nossa equipe é composta por
                        profissionais experientes que aplicam conhecimentos tradicionais e científicos para oferecer
                        tratamentos eficazes e personalizados, com foco na saúde holística e no equilíbrio do corpo e da
                        mente.</p>
                    <p class="mb-4">Ao escolher a Green Word, você opta por uma abordagem natural e segura para cuidar da
                        sua saúde. Estamos comprometidos em proporcionar um atendimento individualizado e de qualidade,
                        respeitando a natureza e utilizando as melhores práticas da medicina tradicional para ajudar você a
                        alcançar uma vida mais saudável e equilibrada.</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Assistência médica de qualidade</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Apenas Médicos Qualificados</p>
                    <p><i class="far fa-check-circle text-primary me-3"></i>Profissionais de Pesquisa Médica</p>

                </div>
            </div>
        </div>
    </div>
@endsection
