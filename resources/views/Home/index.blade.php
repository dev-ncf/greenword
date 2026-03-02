@extends('layouts.home')
@section('content')
    <!-- Header Start -->
    <div class="container-fluid header bg-primary p-0 mb-5">
        <div class="row g-0 align-items-center flex-column-reverse flex-lg-row">
            <div class="col-lg-6 p-5 wow fadeIn" data-wow-delay="0.1s">
                <h1 class="display-4 text-white mb-5">Boa saúde é a raiz de toda a felicidade.</h1>
                <div class="row g-4">
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">{{ $medicos->count() }}</h2>
                            <p class="text-light mb-0">Médicos Especialistas</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">{{ $medicos->count() }}</h2>
                            <p class="text-light mb-0">Equipe Médica</p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="border-start border-light ps-4">
                            <h2 class="text-white mb-1" data-toggle="counter-up">{{ $pacientes->count() }}</h2>
                            <p class="text-light mb-0">Total Pacientes</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="{{ asset('home/img/carousel-1.jpg') }}" alt="">
                        <div class="owl-carousel-text">
                            <h1 class="display-1 text-white mb-0">Cardiologia</h1>
                        </div>
                    </div>

                    <div class="owl-carousel-item position-relative">
                        <img class="img-fluid" src="{{ asset('home/img/carousel-3.jpg') }}" alt="">
                        <div class="owl-carousel-text">
                            <h1 class="display-1 text-white mb-0">Pulmonologia</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
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
                    <p>Na CS-MEPI, nos dedicamos à prática da medicina ervanária, utilizando o poder das plantas
                        medicinais e remédios naturais para tratar e promover o bem-estar. Nossa equipe é composta por
                        profissionais experientes que aplicam conhecimentos tradicionais e científicos para oferecer
                        tratamentos eficazes e personalizados, com foco na saúde holística e no equilíbrio do corpo e da
                        mente.</p>
                    <p class="mb-4">Ao escolher a CS-MEPI, você opta por uma abordagem natural e segura para cuidar da
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
    <!-- About End -->


    <!-- Service Start -->
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
                            <i class="fa fa-newspaper text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Consultas</h4>
                        <p class="mb-4">Consultas referem-se a encontros ou atendimentos realizados entre profissionais de
                            saúde e pacientes, com o objetivo de avaliar, diagnosticar, tratar ou monitorar condições de
                            saúde. Elas podem ocorrer em diferentes áreas da medicina, odontologia, psicologia e outras
                            especialidades.</p>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
                            style="width: 65px; height: 65px;">
                            <i class="fa fa-wheelchair text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Fisioterapia</h4>
                        <p class="mb-4">A fisioterapia é uma área da saúde voltada para a prevenção, diagnóstico e
                            tratamento de disfunções do movimento e problemas relacionados à funcionalidade do corpo humano.
                            Ela utiliza métodos terapêuticos baseados em técnicas manuais, exercícios físicos, equipamentos
                            tecnológicos e outros recursos para promover a reabilitação, aliviar dores, melhorar a qualidade
                            de vida e prevenir lesões ou doenças.</p>

                    </div>
                </div>

                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
                            style="width: 65px; height: 65px;">
                            <i class="fa fa-x-ray text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Fitoterapia</h4>
                        <p class="mb-4">A fitoterapia é uma prática terapêutica que utiliza plantas medicinais e seus
                            derivados para prevenir, aliviar ou tratar doenças e condições de saúde. Ela se baseia nos
                            princípios ativos encontrados nas plantas, como óleos essenciais, alcaloides, flavonoides e
                            outros compostos químicos naturais, que possuem propriedades medicinais reconhecidas.</p>

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item bg-light rounded h-100 p-5">
                        <div class="d-inline-flex align-items-center justify-content-center bg-white rounded-circle mb-4"
                            style="width: 65px; height: 65px;">
                            <i class="fa fa-heartbeat text-primary fs-4"></i>
                        </div>
                        <h4 class="mb-3">Tratamento</h4>
                        <p class="mb-4">Tratamento refere-se a todas as intervenções, métodos ou terapias utilizadas para
                            aliviar sintomas, curar doenças ou melhorar a qualidade de vida de uma pessoa. Ele pode incluir
                            abordagens farmacológicas, não farmacológicas, cirúrgicas ou psicológicas, dependendo da
                            condição ou necessidade do paciente.</p>

                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-primary overflow-hidden my-5 px-lg-0">
        <div class="container feature px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="p-lg-5 ps-lg-0">
                        <p class="d-inline-block border rounded-pill text-light py-1 px-4">Recursos</p>
                        <h1 class="text-white mb-4">Por que escolher-nos?</h1>
                        <p class="text-white mb-4 pb-2">Nossa equipe de médicos altamente qualificados está comprometida em
                            oferecer o melhor atendimento, com foco no cuidado individualizado. Estamos prontos para ajudar
                            você a melhorar sua saúde e alcançar o bem-estar desejado.</p>

                        <div class="row g-4">
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                                        style="width: 55px; height: 55px;">
                                        <i class="fa fa-user-md text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">Experiência</p>
                                        <h5 class="text-white mb-0">Médicos</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                                        style="width: 55px; height: 55px;">
                                        <i class="fa fa-check text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">Qualidade</p>
                                        <h5 class="text-white mb-0">Serviços</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                                        style="width: 55px; height: 55px;">
                                        <i class="fa fa-comment-medical text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">Positivo</p>
                                        <h5 class="text-white mb-0">Consulta</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="d-flex align-items-center">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-light"
                                        style="width: 55px; height: 55px;">
                                        <i class="fa fa-headphones text-primary"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="text-white mb-2">24 Horas</p>
                                        <h5 class="text-white mb-0">Suporte</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pe-lg-0 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="{{ asset('home/img/feature.jpg') }}"
                            style="object-fit: cover;" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Médicos</p>
                <h1>Nossos Médicos Experientes</h1>
            </div>
            <div class="row g-4">
                @foreach ($medicos as $medico)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item position-relative rounded overflow-hidden">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="{{ asset($medico->foto) }}" alt="">
                            </div>
                            <div class="team-text bg-light text-center p-4">
                                <h5>{{ $medico->nome }}</h5>
                                <p class="text-primary">{{ $medico->especialidade }}</p>
                                <div class="team-social text-center">
                                    <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Appointment Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Marcar consulta</p>
                    <h1 class="mb-4">Agende uma Consulta para Visitar Nosso Médico</h1>
                    <p class="mb-4">Nossa equipe de médicos altamente qualificados está pronta para oferecer o melhor
                        atendimento, garantindo cuidados personalizados para cada paciente. Agende sua consulta e descubra
                        como podemos ajudar a melhorar sua saúde e qualidade de vida.</p>
                    <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                            style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Ligue para!</p>
                            <h5 class="mb-0">+258844095646</h5>
                            <h5 class="mb-0">+258844140106</h5>
                            <h5 class="mb-0">+258879995244</h5>
                            <h5 class="mb-0">+25886595646</h5>
                        </div>
                    </div>
                    <div class="bg-light rounded d-flex align-items-center p-5">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white"
                            style="width: 55px; height: 55px;">
                            <i class="fa fa-envelope-open text-primary"></i>
                        </div>
                        <div class="ms-4">
                            <p class="mb-2">Mande um email</p>
                            <h5 class="mb-0">mepinampula@gmail.com</h5>
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
    <!-- Testimonial Start -->
    {{-- <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <p class="d-inline-block border rounded-pill py-1 px-4">Testimonial</p>
                <h1>What Say Our Patients!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                <div class="testimonial-item text-center">
                    <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="img/testimonial-1.jpg"
                        style="width: 100px; height: 100px;">
                    <div class="testimonial-text rounded text-center p-4">
                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna
                            ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea
                            clita.</p>
                        <h5 class="mb-1">Patient Name</h5>
                        <span class="fst-italic">Profession</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="img/testimonial-2.jpg"
                        style="width: 100px; height: 100px;">
                    <div class="testimonial-text rounded text-center p-4">
                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna
                            ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea
                            clita.</p>
                        <h5 class="mb-1">Patient Name</h5>
                        <span class="fst-italic">Profession</span>
                    </div>
                </div>
                <div class="testimonial-item text-center">
                    <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="img/testimonial-3.jpg"
                        style="width: 100px; height: 100px;">
                    <div class="testimonial-text rounded text-center p-4">
                        <p>Clita clita tempor justo dolor ipsum amet kasd amet duo justo duo duo labore sed sed. Magna
                            ut diam sit et amet stet eos sed clita erat magna elitr erat sit sit erat at rebum justo sea
                            clita.</p>
                        <h5 class="mb-1">Patient Name</h5>
                        <span class="fst-italic">Profession</span>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Testimonial End -->
    <script src="{{ asset('home/js/js.js') }}"></script>
@endsection
