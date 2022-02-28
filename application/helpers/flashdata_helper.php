<?php

function readFlash()
{
    if (isset($_COOKIE['msgFlash']))
    {
        echo $_COOKIE['msgFlash'];
        setcookie('msgFlash', '', time()-3600, '/');
        unset($_COOKIE['msgFlash']);
    }
}

function setFlash($title, $msg, $type = 'success')
{
    setcookie('msgFlash', '<div style="padding-left: 150px; padding-right: 150px;">'
            . '<div class="callout callout-'.$type.'">'
            . '<h4>'.$title.'</h4> '
            . '<p>'.$msg.'</p>'
            . '</div>'
            . '</div>', time()+3600, '/');        
}
?>
