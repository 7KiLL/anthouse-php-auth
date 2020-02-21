<?php


namespace App\Controllers;


class LogoutController
{
    public function logout()
    {

        auth()->logoutUser();
        redirect('/login');
    }
}
