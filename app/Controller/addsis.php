<?php

namespace Controller;

use Helpers\HelperResponse;
use Model\User;
use Src\Request;
use Src\View;

class addsis
{
    public function addsis(Request $request): string
    {
        if($_SESSION['role'] == 1){
            if ($request->method === 'POST') {
                $data = $request->all();
                if (isset($data['user_id']) && isset($data['role'])) {
                    $user = User::find($data['user_id']);

                    if ($user) {
                        switch ($data['role']) {
                            case 'make_admin':
                                $user->role = 1;
                                break;
                            case 'make_sysadmin':
                                $user->role = 2;
                                break;
                            case 'make_user':
                                $user->role = 0;
                                break;
                        }
                        $user->save();
                        HelperResponse::redirectWithMessage('/addsis', 'Роль пользователя изменена');
                    }
                }
            }

            $users = User::all();
            return new View('site.addsis', ['users' => $users]);
        }
        return new View('site.hello');
    }
}