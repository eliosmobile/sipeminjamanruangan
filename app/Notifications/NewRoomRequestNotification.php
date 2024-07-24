<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewRoomRequestNotification extends Notification
{
    use Queueable;

    protected $jadwal;

    public function __construct($jadwal)
    {
        $this->jadwal = $jadwal;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Permintaan Jadwal Baru',
            'message' => 'Permintaan jadwal baru untuk ' . $this->jadwal->nama_acara . ' oleh ' . $this->jadwal->nama_organisasi,
        ];
    }
}
