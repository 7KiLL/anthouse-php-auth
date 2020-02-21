<?php


namespace App\Controllers;


use App\Classes\Renderer;
use App\Classes\Request;
use App\Interfaces\ErrorMessages;
use App\Models\User;

class LoginController
{
    public function login(Renderer $renderer, Request $request)
    {
        $message = '';
        if ($err = $request->getQuery('error')) {
            $message = $renderer->render('message', ['text' => $err, 'type' => 'danger']);
        }

        if ($request->isPost()) {
            $user = (new User())->getByEmail($request->post('email'));
            if ($user) {
                if (password_verify($request->post('password'), $user['password'])) {
                    self::auth($user['id']);
                    return $renderer->render('profile', ['name' => $user['username']]);
                } else {
                    $message = $renderer->render('message', ['text' => ErrorMessages::CREDENTIAL_FAIL, 'type' => 'danger']);
                }
            }
        }


        return $renderer->render('login', ['message' => $message]);
    }

    public static function auth($user)
    {
        auth()->authUser($user['id']);
    }
}
