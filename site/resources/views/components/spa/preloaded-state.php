<?php
if(isset($data)) {
    $flags = 0;
    if(config('app.env') !== 'production'){
        $flags = JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE;
    }

    echo '<script type="text/javascript">';
    echo 'window.PS=', json_encode($data, $flags) . ';';
    echo '</script>';
}
