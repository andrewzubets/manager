<?php
if(isset($data)) {
    echo '<script type="text/javascript">';
    echo 'window.PS=', json_encode($data) . ';';
    echo '</script>';
}
