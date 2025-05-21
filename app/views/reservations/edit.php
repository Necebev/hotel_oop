<?php
    $html = <<<HTML
        <form method='post' action='/reservations'>
            <input type='hidden' name='_method' value='PATCH'>
            <input type="hidden" name="id" value="{$reservation->id}">
            <fieldset>
                <label for="reservation">Szoba ID</label>
                <input type="text" name="room_id" id="room_id" value="{$reservation->room_id}">
                <br>
                <label for="reservation">Vendég ID</label>
                <input type="text" name="guest_id" id="guest_id" value="{$reservation->guest_id}">
                <br>
                <label for="reservation">Foglalás hossza</label>
                <input type="text" name="days" id="days" value="{$reservation->days}">
                <br>
                <label for="reservation">Dátum</label>
                <input type="text" name="date" id="date" value="{$reservation->date}">
                <hr>
                <button type="submit" name="btn-update"><i class="fa fa-save"></i>&nbsp;Mentés</button>
                <a href="/reservations"><i class="fa fa-cancel"></i>&nbsp;Mégse</a>
            </fieldset>
        </form>
    HTML;
    echo $html;