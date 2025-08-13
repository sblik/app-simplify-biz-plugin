<?php

namespace SMPLFY\appsimplifybiz;

use GFAPI;
use SmplfyCore\SMPLFY_Log;
use SmplfyCore\UserMeta;

class CoachAbility
{
    private InviteCoachRepository $inviteCoachRepository;

    public function __construct(InviteCoachRepository $inviteCoachRepository)
    {
        $this->inviteCoachRepository = $inviteCoachRepository;
    }

    /**
     * @return void
     */
    function can_coach_edit_entries(): void
    {
        $entryID = htmlspecialchars($_POST["entryID"]);
        SMPLFY_Log::info("Entry ID: ", $entryID);
        if (!empty($entryID)) {
            $entry = GFAPI::get_entry($entryID);

            if (!empty($entry)) {
                $clientUserID = $entry['created_by'];

                $clientUser = get_user_by('ID', $clientUserID);
                if (!empty($clientUser)) {
                    $coachID = UserMeta::retrieve_user_meta($clientUserID, UserMetaKeys::COACH_USER_ID);
                    if (!empty($coachID)) {
                        $coachInviteEntity = $this->inviteCoachRepository->get_one_for_user($clientUserID);
                        SMPLFY_Log::info("Coach invite entity: ", $coachInviteEntity);

                        if (!empty($coachInviteEntity)) {
                            $coachUser = get_user_by('ID', $coachID);

                            if (!empty($coachUser) && $coachUser->ID = get_current_user_id()) {
                                SMPLFY_Log::info("In if coach user");

                                $abilities = $coachInviteEntity->coachPermissions;

                                if ($abilities == 'View AND Edit') {
                                    $returnArray = array("canEditEntries" => true);
                                } else {
                                    $returnArray = array("canEditEntries" => false);
                                }
                                echo json_encode($returnArray);
                                die();
                            }
                        } else {
                            $returnArray = array("canEditEntries" => false);
                            echo json_encode($returnArray);
                            die();
                        }
                    } else {
                        $returnArray = array("canEditEntries" => false);
                        echo json_encode($returnArray);
                        die();
                    }
                } else {
                    $returnArray = array("canEditEntries" => false);
                    echo json_encode($returnArray);
                    die();
                }
            }
        }
    }

    /**
     * @param $entry
     * @param $form
     * @return void
     */
    public function handle_coach_removal($entry, $form): void
    {
        $removeCoachEntity = new RemoveCoachEntity($entry);
        $submitterUserID   = get_current_user_id();

        $coachIDInRecord = UserMeta::retrieve_user_meta($submitterUserID, UserMetaKeys::COACH_USER_ID);
        $coachIDInEntry  = $removeCoachEntity->coachUserID;

        if ($coachIDInEntry == $coachIDInRecord) {
            //Remove Coach ID from user meta
            UserMeta::store_user_meta($submitterUserID, UserMetaKeys::COACH_USER_ID, '');
        }
    }
}