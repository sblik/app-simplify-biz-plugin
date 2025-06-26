<?php

namespace SMPLFY\appsimplifybiz;


use SmplfyCore\SMPLFY_Log;

class UserRegistered
{

    private InviteGuestRepeaterRepository $inviteGuestRepeaterRepository;

    public function __construct(
        InviteGuestRepeaterRepository $inviteGuestRepeaterRepository,
    )
    {
        $this->inviteGuestRepeaterRepository = $inviteGuestRepeaterRepository;
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
    public function handle_ticket_assigned($userId, $feed, $entry)
    {
        SMPLFY_Log::info("UserRegistered in gravity forms: ", $entry);
        $formId = $entry['form_id'];

        if ($formId == FormIds::INVITE_GUEST_REPEATER) {
            $inviteEntry = new InviteGuestRepeaterEntity($entry);

            $inviteEntry->workflowUser = $userId;
            $inviteEntry->createdBy    = get_current_user_id();
            $this->inviteGuestRepeaterRepository->update($inviteEntry);

        }

    }

}