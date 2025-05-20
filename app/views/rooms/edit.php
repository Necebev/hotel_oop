<?php
    $html = <<<HTML
        <form method='post' action='/rooms'>
            <input type='hidden' name='_method' value='PATCH'>
            <input type="hidden" name="id" value="{$room->id}">
            <fieldset>
                <label for="room">Emelet</label>
                <input type="text" name="floor" id="floor" value="{$room->floor}">
                <br>
                <label for="room">Szobaszám</label>
                <input type="text" name="room_number" id="room_number" value="{$room->room_number}">
                <br>
                <label for="room">Férőhelyek</label>
                <input type="text" name="space" id="space" value="{$room->space}">
                <br>
                <label for="room">Ár</label>
                <input type="text" name="price" id="price" value="{$room->price}">
                <br>
                <label for="room">Megjegyzés</label>
                <input type="text" name="note" id="note" value="{$room->note}">
                <hr>
                <button type="submit" name="btn-update"><i class="fa fa-save"></i>&nbsp;Mentés</button>
                <a href="/rooms"><i class="fa fa-cancel"></i>&nbsp;Mégse</a>
            </fieldset>
        </form>
    HTML;
    echo $html;