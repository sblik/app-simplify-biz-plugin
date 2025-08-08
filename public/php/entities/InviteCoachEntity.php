<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $setPasswordLink
 * @property $coachUserID
 * @property $coachNameFirst
 * @property $coachNameLast
 * @property $coachEmail
 * @property $coachPhone
 * @property $coachPermissions
 */
class InviteCoachEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::INVITE_COACH;
    }

    protected function get_property_map(): array
    {
        return array(
            'setPasswordLink'  => '2',
            'coachUserID'      => '3',
            'coachNameFirst'   => '1.3',
            'coachNameLast'    => '1.6',
            'coachEmail'       => '6',
            'coachPhone'       => '7',
            'coachPermissions' => '9',
        );
    }
}