<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $dados; // Variável para os dados que serão passados para o email

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.mail')
                    ->subject('Solicitação de agenda!')
                    ->with('dados', $this->dados);
    }
}
