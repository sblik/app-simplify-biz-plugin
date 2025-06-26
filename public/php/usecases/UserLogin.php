<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;
use SmplfyCore\UserActions;

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
        SMPLFY_Log::info("handle_redirect triggered -------------");
        $overviewEntity  = $this->overviewRepository->get_one_for_current_user();
        $marketingEntity = $this->marketingPlanRepository->get_one_for_current_user();

        if (!empty($overviewEntity) && !empty($marketingEntity)) {

            return '/dashboard/';
        } else {
            return '/start/';
        }
    }
}