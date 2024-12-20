@extends('layouts.home')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <h1 class="display-3 text-success mb-3 animated slideInDown">Services</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb text-uppercase mb-0">
                    <li class="breadcrumb-item"><a class="text-success" href="#">Início</a></li>
                    <li class="breadcrumb-item"><a class="text-success" href="#">Páginas</a></li>
                    <li class="breadcrumb-item text-primary active" aria-current="page">Serviços</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Page Header End -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Serviços</p>
                <h1>Soluções de Cuidados de Saúde</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
                            style="width: 65px; height: 65px;">
                            <i class="fa fa-heartbeat text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Cardiologia</h4>
                        <p class="mb-4">A cardiologia é a especialidade médica que trata de doenças do coração e do
                            sistema circulatório, como hipertensão, arritmias e doenças cardíacas.</p>
                        <p class="mb-4 hidden" id="l-m-c">Cardiologistas utilizam exames como eletrocardiogramas (ECG),
                            ecocardiogramas e
                            testes de esforço para diagnosticar e monitorar condições cardíacas. O tratamento pode incluir
                            medicação, mudanças no estilo de vida e, em alguns casos, procedimentos cirúrgicos. O objetivo
                            da cardiologia é prevenir doenças cardíacas, melhorar a função do coração e garantir uma vida
                            saudável e longa aos pacientes.</p>
                        <a class="btn" id="btn-l-c"><i class="fa fa-plus text-primary me-3"></i>Ler mais</a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
                            style="width: 65px; height: 65px;">
                            <i class="fa fa-x-ray text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Pulmonologia</h4>
                        <p class="mb-4">A pulmonologia é a especialidade médica que se dedica ao diagnóstico e tratamento
                            de doenças dos pulmões e do sistema respiratório, como asma, pneumonia, DPOC (doença pulmonar
                            obstrutiva crônica) e câncer de pulmão.</p>
                        <p class="mb-4 hidden" id="l-m-p">Os pneumologistas realizam exames como radiografias,
                            tomografias e
                            espirometria
                            para avaliar a função pulmonar e diagnosticar doenças respiratórias. O tratamento envolve
                            medicação, terapias respiratórias e, em alguns casos, cirurgia. O objetivo da pulmonologia é
                            promover a saúde pulmonar, aliviar sintomas e prevenir complicações respiratórias.</p>
                        <a class="btn" id="btn-l-p"><i class="fa fa-plus text-primary me-3"></i>Ler mais</a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
                            style="width: 65px; height: 65px;">
                            <i class="fa fa-wheelchair text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Ortopedia</h4>
                        <p class="mb-4">A ortopedia é a especialidade médica que trata de doenças e lesões nos ossos,
                            articulações, músculos, ligamentos e tendões, como fraturas, artrite e lesões esportivas.</p>
                        <p class="mb-4 hidden" id="l-m-o">Os ortopedistas utilizam exames como raios-X, ressonância
                            magnética
                            (RM) e
                            tomografia computadorizada (TC) para diagnosticar condições musculoesqueléticas. O tratamento
                            pode incluir medicação, fisioterapia e cirurgias como a colocação de próteses articulares. O
                            objetivo da ortopedia é restaurar a mobilidade, aliviar a dor e melhorar a qualidade de vida do
                            paciente.</p>
                        <a class="btn" id="btn-l-o"><i class="fa fa-plus text-primary me-3"></i>Ler mais</a>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
