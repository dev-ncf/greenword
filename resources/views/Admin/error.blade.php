
    <div id="container">

        <div id="error-box">
            <div class="dot" id="dot">x</div>
            <div class="face2">
                <div class="eye"></div>
                <div class="eye right"></div>
                <div class="mouth sad"></div>
            </div>
            <div class="shadow move"></div>
            <div class="message">
                <h1 class="alert">Error!</h1>
                <ol >

                    @foreach ($errors->all() as $error)
                        <li>

                            {{ $error }}
                        </li>
                    @endforeach
                    </ol>
            </div>

        </div>
    </div>

