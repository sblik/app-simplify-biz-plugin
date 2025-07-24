<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;
use SmplfyCore\UserActions;
use WP_User;

class UserLogin
{

    private StrategyRepository $strategyRepository;

    private MarketingRepository $marketingRepository;

    public function __construct(StrategyRepository $strategyRepository, MarketingRepository $marketingRepository)
    {
        $this->strategyRepository  = $strategyRepository;
        $this->marketingRepository = $marketingRepository;
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
    public function handle_redirect($redirect_to, $user): string
    {
        $strategyEntity  = $this->strategyRepository->get_one_for_user($user->ID);
        $marketingEntity = $this->marketingRepository->get_one_for_user($user->ID);

        if (UserActions::does_user_have_role($user, 'administrator')) {
            return '/wp-admin';
        }

        if (!empty($strategyEntity) && !empty($marketingEntity)) {
            return '/dashboard/';
        } else {
            return '/start/';
        }


    }
}