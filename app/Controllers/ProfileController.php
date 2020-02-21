<?php


namespace App\Controllers;


use App\Classes\Renderer;
use App\Interfaces\ErrorMessages;

class ProfileController
{
    public function home(Renderer $renderer)
    {
        if (!auth()->isAuthenticated()) {
            redirect('/login?error='.ErrorMessages::UNAUTHENTICATED);
        }
        return $renderer->render('profile', ['name' => auth()->getUser()['username']]);
    }
}
