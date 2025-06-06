<?php
$tableBody = "";
foreach ($rooms as $room) {
    
    $room_number = $room->room_number < 10 ? 0 . $room->room_number : $room->room_number;
    $tableBody .= <<<HTML
            <tr>
                <td>{$room->id}</td>
                <td>{$room->floor}{$room_number}</td>
                <td>{$room->space}</td>
                <td>{$room->price}</td>
                <td>{$room->note}</td>
                <td class='flex float-right'>
                    <form method='post' action='/rooms/edit'>
                        <input type='hidden' name='id' value='{$room->id}'>
                        <button type='submit' name='btn-edit' title='Módosít'><i class='fa fa-edit'></i></button>
                    </form>
                    <form method='post' action='/rooms'>
                        <input type='hidden' name='id' value='{$room->id}'>    
                        <input type='hidden' name='_method' value='DELETE'>
                        <button type='submit' name='btn-del' title='Töröl'><i class='fa fa-trash trash'></i></button>
                    </form>
                </td>
            </tr>
            HTML;
}

$html = <<<HTML
        <table id='admin-rooms-table' class='admin-rooms-table'>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Szobaszám</th>
                    <th>Férőhelyek</th>
                    <th>Ár</th>
                    <th>Megjegyzés</th>
                    <th>
                        <form method='post' action='/rooms/create'>
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





