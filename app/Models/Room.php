<?php

namespace App\Models;

class Room extends Model
{
    public int|null $floor = null;
    public int|null $room_number = null;
    public int|null $space = null;
    public int|null $price = null;
    public string|null $note = null;


    protected static $table = 'rooms';

    public function __construct(?int $floor = null, ?int $room_number = null, ?int $space = null, ?int $price = null, ?string $note = null)
    {
        parent::__construct();
        if ($floor) {
            $this->floor = $floor;
        }
        if ($room_number) {
            $this->room_number = $room_number;
        }
        if ($space) {
            $this->space = $space;
        }
        if ($price) {
            $this->price = $price;
        }
        if ($note) {
            $this->note = $note;
        }
    }
}