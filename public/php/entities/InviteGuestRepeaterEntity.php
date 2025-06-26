<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $nameFirst
 * @property $nameLast
 * @property $email
 * @property $phone
 * @property $typeOfTicketAssigned
 * @property $workflowUser
 * @property $invitorUserID
 */
class InviteGuestRepeaterEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::INVITE_GUEST_REPEATER;
    }

    protected function get_property_map(): array
    {
        return array(
            'invitorUserID'        => '5',
            'guestUsername'        => '12',
            'nameFirst'            => '1.3',
            'nameLast'             => '1.6',
            'email'                => '4',
            'phone'                => '3',
            'typeOfTicketAssigned' => '10',
            'workflowUser'         => '14',
        );
    }
}