<?php
use App\Database\Database;
$rooms = Database::getInstance()->execSql("SELECT id, floor, room_number FROM rooms");
$guests = Database::getInstance()->execSql("SELECT id, name FROM guests");
$reservations = Database::getInstance()->execSql("SELECT * FROM reservations");
$html = "<form method='post' action='/reservations'>
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
                <input type='number' name='days' id='days' min=0 value='1'>
                <br>
                <label for='date'>Dátum</label>
                <input type='date' name='date' id='date' value='".date('Y-m-d')."'>
                <hr>
                <button type='submit' name='btn-save'><i class='fa fa-save'></i>&nbsp;Mentés</button>
                <a href='/reservations'><i class='fa fa-cancel'></i>&nbsp;Mégse</a>
            </fieldset>
        </form>
    ";

echo $html;