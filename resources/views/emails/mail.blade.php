@component('mail::message')
    # Olá, {{ $dados['nome'] }}

    Obrigado por entrar em contato!

    Esperamos que esta mensagem o(a) encontre bem.

    {{ $dados['mensagem'] }}
    Caso tenha alguma preferência ou dúvida, por favor, não hesite em nos comunicar através deste e-mail ou pelo telefone
    +258844095646.
    Agradecemos pela compreensão e pela confiança em nosso atendimento.

    Atenciosamente,
    {{ config('app.name') }}
@endcomponent
