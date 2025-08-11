<?php

namespace SMPLFY\appsimplifybiz;


use GFAPI;
use SmplfyCore\SMPLFY_Log;
use SmplfyCore\UserActions;
use SmplfyCore\UserMeta;
use WP_User;

class CoachInvite
{

    private InviteCoachRepository $inviteCoachRepository;

    public function __construct(InviteCoachRepository $inviteCoachRepository)
    {
        $this->inviteCoachRepository = $inviteCoachRepository;
    }

    public function handle_coach_invite_submission($entry, $form): void
    {
        $inviteCoachEntity = new InviteCoachEntity($entry);
        $coachUser         = get_user_by_email($inviteCoachEntity->coachEmail);
        SMPLFY_Log::info("Coach User: ", $coachUser);

        if (!empty($coachUser)) {
            $this->handle_coach_after_invite($coachUser, $inviteCoachEntity);

            $submitterUser = get_user_by('ID', $inviteCoachEntity->createdBy);
            if (!empty($submitterUser)) {
                UserMeta::store_user_meta($coachUser->ID, UserMetaKeys::COACH_USER_ID, $submitterUser->ID);
            } else {
                SMPLFY_Log::error("Submitter user not found in handle_coach_invite_submission");
            }
        } else {
            SMPLFY_Log::error("Coach User Not found in handle_coach_invite_submission");
        }

    }

    /**
     * @param WP_User $user
     * @param InviteCoachEntity $inviteCoachEntity
     * @param mixed $form
     * @return void
     */
    public function handle_coach_after_invite(WP_User $user, InviteCoachEntity $inviteCoachEntity): void
    {
        $user->add_role(Roles::COACH);
        UserMeta::store_user_meta($user->ID, UserMetaKeys::MOBILE, $inviteCoachEntity->coachPhone);

        $userSetPasswordLink                = UserActions::generate_password_link($user->ID);
        $inviteCoachEntity->setPasswordLink = $userSetPasswordLink;

        $this->inviteCoachRepository->update($inviteCoachEntity);

        $form = GFAPI::get_form(FormIds::INVITE_COACH);
        GFAPI::send_notifications($form, $inviteCoachEntity->formEntry);
    }
}