<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;
use SmplfyCore\UserActions;
use WP_User;

class UserLogin
{

    private OverviewRepository      $overviewRepository;
    private MarketingPlanRepository $marketingPlanRepository;

    public function __construct(OverviewRepository $overviewRepository, MarketingPlanRepository $marketingPlanRepository)
    {
        $this->overviewRepository      = $overviewRepository;
        $this->marketingPlanRepository = $marketingPlanRepository;
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
        $overviewEntity  = $this->overviewRepository->get_one_for_user($user->ID);
        $marketingEntity = $this->marketingPlanRepository->get_one_for_user($user->ID);

        if (!empty($overviewEntity) && !empty($marketingEntity)) {

            return '/dashboard/';
        } else {
            return '/start/';
        }
    }
}