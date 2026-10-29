<?php
    echo '<h2>POST recibido</h2>';

    echo '<h3>$_POST completo:</h3>';
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';


    echo '<h3>$_POST[\'mod\'] (lo que nos interesa):</h3>';
    if (isset($_POST['mod'])) {
        echo '<pre>';
        print_r($_POST['mod']);
        echo '</pre>';
    } else {
        echo '<p style="color:red">No ha llegado $_POST[\'mod\']</p>';
    }
?>