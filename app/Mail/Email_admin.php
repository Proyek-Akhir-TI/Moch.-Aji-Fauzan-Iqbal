<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email_admin extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($topik,$nama,$waktu)
    {
        $this->topik = $topik;
        $this->nama = $nama;
        $this->waktu = $waktu;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('aji.bwi99@gmail.com')
            ->view('eadmin')
            ->with(
            [
                'topik'=> $this->topik,
                'nama' => $this->nama,
                'waktu'=> $this->waktu
            ]);
    }
}