<?php
echo <<<HTML
        <form method='post' action='/guests'>
            <fieldset>
                <label for="name">Név</label>
                <input type="text" name="name" id="name">
                <br>
                <label for="age">Kor</label>
                <input type="text" name="age" id="age">
                <hr>
                <button type="submit" name="btn-save"><i class="fa fa-save"></i>&nbsp;Mentés</button>
                <a href="/guests"><i class="fa fa-cancel"></i>&nbsp;Mégse</a>
            </fieldset>
        </form>
    HTML;