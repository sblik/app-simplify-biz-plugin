<?php

namespace SMPLFY\appsimplifybiz;

use MeprUser;
use SmplfyCore\SMPLFY_Log;
use SmplfyCore\UserActions;
use SmplfyCore\UserMeta;

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
        SMPLFY_Log::info("Signup completed transaction data: ", $txn_data);

        if (!empty($user)) {
            $userID       = $user->ID;
            $organisation = UserMeta::retrieve_user_meta($userID, 'mepr_organization');

            $organisationLookupEntity = new OrganisationLookupEntity();

            $organisationLookupEntity->userID           = $userID;
            $organisationLookupEntity->createdBy        = $userID;
            $organisationLookupEntity->organisationName = $organisation;

            $this->organisationLookupRepository->add($organisationLookupEntity);
        }
    }

    function mepr_custom_thankyou_message_fn($message)
    {
        $mepr_user = new MeprUser(get_current_user_id());

        if ($mepr_user->is_active_on_membership(Memberships::COACH)) {
            wp_redirect('app.simplifybiz.com/coach-view-operations/');
        }
    }
}