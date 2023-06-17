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
function is_user()
{
    $ci = get_instance();
    $category = $ci->session->userdata('category');
    if ($category == 'user') {
        return true;
    } else {
        return false;
    }
}
function is_admin()
{
    $ci = get_instance();
    $category = $ci->session->userdata('category');
    if ($category == 'admin') {
        return true;
    } else {
        return false;
    }
}
