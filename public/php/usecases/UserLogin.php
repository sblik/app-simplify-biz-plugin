<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;
use SmplfyCore\UserActions;

class UserLogin
{

    public function __construct()
    {

    }

    /**
     * Entry method for the use case to handle a user registration.
     *
     * @param $userId
     * @param $feed
     * @param $entry
     *
     * @return void
     */
    public function handle_redirect($redirect_to, $request, $user): string
    {
        SMPLFY_Log::info("Mpress handle_redirect triggered -------------");
        if (UserActions::does_user_have_role($user, 'attendee')) {
            return '/attendee/';
        }
        return $redirect_to;
    }
}