<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;

class SignUp
{
    private OrganisationLookupRepository $organisationLookupRepository;

    public function __construct(OrganisationLookupRepository $organisationLookupRepository)
    {
        $this->organisationLookupRepository = $organisationLookupRepository;
    }

    /**
     * @param $event
     * @return void
     */
    function signup_completed($event): void
    {
        $user     = $event->get_data();
        $txn_data = json_decode($event->args);

        SMPLFY_Log::info("Signup completed event: ", $event);
        SMPLFY_Log::info("Signup completed user: ", $user);

        if (!empty($user)) {
            $organisationLookupEntity = new OrganisationLookupEntity();

            $organisationLookupEntity->userID    = $user->ID;
            $organisationLookupEntity->createdBy = $user->ID;

        }

    }

}