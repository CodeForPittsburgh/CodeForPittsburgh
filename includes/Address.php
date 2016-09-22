<?php

FormSetup();

function Formsetup() {

    echo '<form>';
    echo '<input id="address">';
    echo ' </input>';

    echo '<input type="button" value="Submit" onclick="createURLcall(\'address\')" >';
    echo '</form>';
}
