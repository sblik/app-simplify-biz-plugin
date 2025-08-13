<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $coachUserID
 * @property $coachNameFirst
 * @property $coachNameLast
 * @property $coachEmail
 * @property $confirmation
 */
class RemoveCoachEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::REMOVE_COACH;
    }

    protected function get_property_map(): array
    {
        return array(
            'coachUserID'    => '1',
            'coachNameFirst' => '4.3',
            'coachNameLast'  => '4.6',
            'coachEmail'     => '5',
            'confirmation'   => '7',
        );
    }
}