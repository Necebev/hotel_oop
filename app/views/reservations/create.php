<?php
echo <<<HTML
        <form method='post' action='/reservations'>
            <fieldset>
                <label for="room_id">Szoba ID</label>
                <input type="text" name="room_id" id="room_id">
                <br>
                <label for="guest_id">Vendég ID</label>
                <input type="text" name="guest_id" id="guest_id">
                <br>
                <label for="days">Foglalás hossza</label>
                <input type="text" name="days" id="days">
                <br>
                <label for="date">Dátum</label>
                <input type="text" name="date" id="date">
                <hr>
                <button type="submit" name="btn-save"><i class="fa fa-save"></i>&nbsp;Mentés</button>
                <a href="/reservations"><i class="fa fa-cancel"></i>&nbsp;Mégse</a>
            </fieldset>
        </form>
    HTML;