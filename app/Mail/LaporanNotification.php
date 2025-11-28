<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LaporanNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $jenis;   // pengaduan / aspirasi / permintaan
    public $statusUpdate; // true ketika notifikasi perubahan status

    public function __construct($data, $jenis, $statusUpdate = false)
    {
        $this->data = $data;
        $this->jenis = $jenis;
        $this->statusUpdate = $statusUpdate;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->statusUpdate 
                ? "Update Status {$this->jenis}" 
                : "Konfirmasi {$this->jenis} Anda"
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.laporan-notification',
            with: [
                'data' => $this->data,
                'jenis' => $this->jenis,
                'statusUpdate' => $this->statusUpdate
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
