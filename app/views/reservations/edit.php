<?php
use App\Database\Database;
$rooms = Database::getInstance()->execSql("SELECT * FROM rooms");
$guests = Database::getInstance()->execSql("SELECT * FROM guests");
$html = "<form method='post' action='/reservations'>
            <input type='hidden' name='_method' value='PATCH'>
            <input type='hidden' name='id' value='{$reservation->id}'>
            <fieldset>
                <label for='room_id'>Szoba</label>
                <select name='room_id' id='room_id'>";
foreach ($rooms as $room) {
    $room_number = $room['floor'] . ($room['room_number'] < 10 ? '0' . $room['room_number'] : $room['room_number']);
    $html .= "<option value='{$room['id']}'>$room_number</option>";
}
$html .= "
                </select>
                <br>
                <label for='guest_id'>Vendég</label>
                <select name='guest_id' id='guest_id'>";
foreach ($guests as $guest) {
    $html .= "<option value='{$guest['id']}'>{$guest['name']}</option>";
}
$html .="
                </select>
                <br>
                <label for='days'>Foglalás hossza</label>
                <input type='number' name='days' id='days' min=0 value={$reservation->days}>
                <br>
                <label for='date'>Dátum</label>
                <input type='date' name='date' id='date' value='{$reservation->date}'>
                <hr>
                <button type='submit' name='btn-update'><i class='fa fa-save'></i>&nbsp;Mentés</button>
                <a href='/reservations'><i class='fa fa-cancel'></i>&nbsp;Mégse</a>
            </fieldset>
        </form>";
    
    echo $html;