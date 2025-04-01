<?php

namespace Controller;

use Model\Subdivision;
use Model\AttachedUser;
use Src\Request;
use Src\View;

class phonesBySubdivision
{
    public function phonesBySubdivision(Request $request): string
    {
        if ($_SESSION['role'] == 2) {
            $subdivisions = Subdivision::with([
                'rooms.attachedUsers' => function($query) {
                    $query->with([
                        'subscriber' => function($q) {
                            $q->select('id', 'Surname', 'Name');
                        },
                        'phone' => function($q) {
                            $q->select('id', 'number_phone');
                        }
                    ]);
                }
            ])->get();

            return (new View('site.phonesBySubdivision', [
                'subdivisions' => $subdivisions
            ]));
        }

        return new View('site.hello');
    }
}