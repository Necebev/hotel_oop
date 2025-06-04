<?php
    $html = <<<HTML
        <form method='post' action='/rooms'>
            <input type='hidden' name='_method' value='PATCH'>
            <input type="hidden" name="id" value="{$room->id}">
            <fieldset>
                <label for="room">Emelet</label>
                <!-- <input list="floors" name="floor" id="floor" placeholder="{$room->floor}"> -->
                <select name="floor" id="floor" value="{$room->floor}">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
                
                <!-- <input type="text" name="floor" id="floor" value="{$room->floor}"> -->
                <br>
                <label for="room">Szobaszám</label>
                <input list="rooms" name="room_number" id="room_number" value="{$room->room_number}">
                <datalist id="rooms">
                    <option value="1">
                    <option value="2">
                    <option value="7">
                    <option value="8">
                    <option value="9">
                </datalist>
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