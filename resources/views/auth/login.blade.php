<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
    {{-- @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $e)
        <li>{{$e}}</li>
        @endforeach
    </ul>

    @endif --}}
    <div
        class="container @error('name-r') right-panel-active @enderror @error('email-r') right-panel-active @enderror @error('password-r') right-panel-active @enderror @error('password_confirmation') right-panel-active @enderror  ">

        <!-- Sign Up -->
        <div class="container__form container--signup ">

            <form action="{{ route('register') }}" class="form" id="form1" method="POST">
                @csrf
                <h2 class="form__title">Cadastro</h2>
                <input type="text" placeholder="Nome" class="input  @error('name-r') is-invalid @enderror"
                    name="name-r" value="{{ old('name-r') }}" required autocomplete="name" autofocus />
                @error('name-r')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="email" placeholder="Email" class="input  @error('email-r') is-invalid @enderror"
                    name="email-r" value="{{ old('email-r') }}" required autocomplete="email" />
                @error('email-r')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" placeholder="Senha" class="input  @error('password-r') is-invalid @enderror"
                    name="password-r" required autocomplete="new-password" />
                @error('password-r')
                
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" placeholder="Confirmar senha"
                    class="input  @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                    required autocomplete="new-password" />
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button type="submit" class="btn">Cadastrar</button>
            </form>
        </div>

        <!-- Sign In -->
        <div class="container__form container--signin">
            <form action="{{ route('login') }}" class="form" id="form2" method="POST">
                @csrf
                <h2 class="form__title">Iniciar Sessão</h2>
                <input type="email" placeholder="Email" class="input @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                <input type="password" placeholder="Senha" class="input @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <a href="#" class="link">Esqueceu senha?</a>
                <button type="submit" class="btn">Iniciar Sessão</button>
            </form>
        </div>

        <!-- Overlay -->
        <div class="container__overlay">
            <div class="overlay">
                <div class="overlay__panel overlay--left">
                    <button class="btn" id="signIn">Iniciar Sessão</button>
                </div>
                <div class="overlay__panel overlay--right">
                    <button class="btn" id="signUp">Cadastrar-se</button>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>
