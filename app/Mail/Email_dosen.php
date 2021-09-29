<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email_dosen extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($topik,$nama,$status,$waktu)
    {
        $this->topik = $topik;
        $this->nama = $nama;
        $this->status = $status;
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
            ->view('edosen')
            ->with(
            [
                'topik'=> $this->topik,
                'nama'=> $this->nama,
                'status' => $this->status,
                'waktu'=> $this->waktu
            ]);
    }
}