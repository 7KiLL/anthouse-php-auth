<?php


namespace App\Controllers;


use App\Classes\Renderer;
use App\Classes\Request;
use App\Models\User;

class RegisterController
{
    const REGISTER_FIELDS = [
        'username',
        'email',
        'password'
    ];
    /** @var Renderer */
    private $renderer;

    public function register(Renderer $renderer, Request $request)
    {
        if ($request->isPost()) {
            $params = $request->paramBag();
            if (self::validate($params)) {
                $params['password'] = bcrypt($params['password']);
                $user = User::create($params);
                if ($user) {
                    $user = (new User())->getByEmail($params['email']);
                    auth()->authUser($user['id']);
                    redirect('/profile');
                } else {
                    redirect('/register?error=Looks like this email is already in use...');
                }
            }

        }
        $message = null;
        if ($err = $request->get('error')) {
            $message = $renderer->render('message', ['text' => $err, 'type' => 'danger']);
        }
        return $renderer->render('register', ['message' => $message]);
    }

    private static function validate(array $data)
    {
        $fields = array_keys($data);

        $errorBag = [];

        if (array_diff(self::REGISTER_FIELDS, $fields) != []) {
            echo (new Renderer())->render('register', [
                'message' => (new Renderer())->render('message', ['type' => 'danger', 'text' => 'Submit all the required fields'])
            ]);
            exit();
        }


        if (strlen($data['username']) < 6) {
            $errorBag[] = 'Username must be more than 6 characters';
        }
        if (strlen($data['password']) < 6) {
            $errorBag[] = 'Password must be more than 6 characters';
        }

        $alert = '';
        if (count($errorBag) > 0) {

            $alert = (new Renderer())->render('message', ['type' => 'danger', 'message' => join("<br>", $errorBag)]);
            echo (new Renderer())->render('register', [
                'message' => $alert
            ]);
            exit();
        }

        return true;
    }
}
