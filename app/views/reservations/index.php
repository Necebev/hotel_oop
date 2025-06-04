<?php
use App\Database\Database;
use App\Views\Display;
$tableBody = "";
foreach ($reservations as $reservation) { // Store reservation ID in session for potential use
    $floor = Database::getInstance()->execSql("select floor, room_number from rooms where id = $reservation->room_id")[0];
    $room_number = $floor['floor'] . ($floor['room_number'] < 10 ? '0' . $floor['room_number'] : $floor['room_number']);
    $guest = Database::getInstance()->execSql("select name from guests where id = $reservation->guest_id")[0]['name'];
    $tableBody .= <<<HTML
            <tr>
                <td>{$reservation->id}</td>
                <td>{$room_number}</td>
                <td>{$guest}</td>
                <td>{$reservation->days} nap</td>
                <td>{$reservation->date}</td>
                <td class='flex float-right'>
                    <form method='post' action='/reservations/edit'>
                        <input type='hidden' name='id' value='{$reservation->id}'>
                        <button type='submit' name='btn-edit' title='Módosít'><i class='fa fa-edit'></i></button>
                    </form>
                    <form method='post' action='/reservations'>
                        <input type='hidden' name='id' value='{$reservation->id}'>    
                        <input type='hidden' name='_method' value='DELETE'>
                        <button type='submit' name='btn-del' title='Töröl'><i class='fa fa-trash trash'></i></button>
                    </form>
                </td>
            </tr>
            HTML;
}

$html = <<<HTML
        <table id='admin-reservations-table' class='admin-reservations-table'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Szobaszám</th>
                    <th>Vendég</th>
                    <th>Foglalás hossza</th>
                    <th>Dátum</th>
                    <th>
                        <form method='post' action='/reservations/create'>
                            <button type="submit" name='btn-plus' title='Új'><i class='fa fa-plus plus'></i>&nbsp;Új</button>
                        </form>
                    </th>
                </tr>
            </thead>
             <tbody>%s</tbody>
            <tfoot>
            </tfoot>
        </table>
        HTML;

echo sprintf($html, $tableBody);





