<?php
echo <<<HTML
        <form method='post' action='/rooms'>
            <fieldset>
                <label for="floor">Emelet</label>
                <input type="text" name="floor" id="floor">
                <br>
                <label for="room_number">Szobaszám</label>
                <input type="text" name="room_number" id="room_number">
                <br>
                <label for="space">Férőhelyek</label>
                <input type="text" name="space" id="space">
                <br>
                <label for="price">Ár</label>
                <input type="text" name="price" id="price">
                <br>
                <label for="note">Megjegyzés</label>
                <input type="text" name="note" id="note">
                <hr>
                <button type="submit" name="btn-save"><i class="fa fa-save"></i>&nbsp;Mentés</button>
                <a href="/rooms"><i class="fa fa-cancel"></i>&nbsp;Mégse</a>
            </fieldset>
        </form>
    HTML;