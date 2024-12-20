@extends('layouts.home')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-success mb-3 animated slideInDown">Agendar Consulta</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-success" href="#">Início</a></li>
                    <li class="breadcrumb-item"><a class="text-success" href="#">Página</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Agendar</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Agendar</p>
                    <h1 class="mb-4">Agende Sua Consulta com Nosso Médico</h1>
                    <p class="mb-4">Reserve um momento para cuidar da sua saúde. Nossos especialistas estão prontos para
                        oferecer o melhor atendimento, garantindo cuidado, conforto e bem-estar em cada consulta. Sua saúde
                        é nossa prioridade.</p>

                    <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                            style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Entre em contacto já</p>
                            <h5 class="mb-0">+258800000000</h5>
                        </div>
                    </div>
                    <div class="bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                            style="width: 55px; height: 55px;">
                            <i class="fa fa-envelope-open text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Envie um email</p>
                            <h5 class="mb-0">info@example.com</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                        <form action="{{ route('store-agendas', 'Externa') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Seu Nome"
                                        style="height: 55px;" name="paciente">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control border-0" placeholder="Seu Email"
                                        style="height: 55px;" name="email">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control border-0" placeholder="Seu Contacto"
                                        style="height: 55px;" name="contacto">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select border-0" style="height: 55px;" name="medico_id">
                                        <option selected disabled>Escolha o Médico</option>
                                        @foreach ($medicos as $medico)
                                            <option value="{{ $medico->id }}">{{ $medico->nome }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="text" class="form-control border-0 datetimepicker-input"
                                            placeholder="Escolher Data" data-target="#date" data-toggle="datetimepicker"
                                            style="height: 55px;" name="data">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="time" id="time" data-target-input="nearest">
                                        <input type="text" class="form-control border-0 datetimepicker-input"
                                            placeholder="Escolher Hora" data-target="#time" data-toggle="datetimepicker"
                                            style="height: 55px;" name="hora">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control border-0" rows="5" placeholder="Descreva o seu problema!" name="descricao"></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Agendar </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->

    @if ($errors->any())
        @include('Admin.error')
    @endif
    @if (session('success'))
        @include('Admin.success')
    @endif
@endsection
