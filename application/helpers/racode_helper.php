<?php
function is_login()
{
    $ci = get_instance();
    $login = $ci->session->userdata('logged_in');
    if ($login == 1) {
        return true;
    } else {
        return false;
    }
}
