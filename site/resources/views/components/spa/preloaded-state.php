<?php

echo '<script type="text/javascript">';
echo 'window.PS=', app('preloaded_state')->toJson().';';
echo '</script>';
