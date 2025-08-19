<?php

namespace SMPLFY\appsimplifybiz;

use TablePress\PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sign;

class MemberpressAdapter
{
    private UserLogin $userLogin;
    private SignUp    $signUp;

    public function __construct(UserLogin $userLogin, SignUp $signUp)
    {
        $this->userLogin = $userLogin;
        $this->signUp    = $signUp;

        $this->register_hooks();
        $this->register_filters();
    }

    /**
     * Register gravity forms hooks to handle custom logic
     *
     * @return void
     */
    public function register_hooks()
    {
        add_action('mepr-event-member-signup-completed', [$this->signUp, 'signup_completed']);
    }

    /**
     * Register gravity forms filters to handle custom logic
     *
     * @return void
     */
    public function register_filters()
    {
        add_filter('mepr-process-login-redirect-url', [$this->userLogin, 'handle_redirect'], 11, 2);
        add_filter('mepr_custom_thankyou_message', [$this->signUp, 'mepr_custom_thankyou_message_fn']);
        add_filter('mepr-rule-redirect-unauthorized-url', [$this->signUp, 'redirect_coach_unauthorised', 10, 3]);
    }
}