<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $nestedForm
 *
 */
class InviteGuestParentEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::INVITE_GUEST_PARENT;
    }

    protected function get_property_map(): array
    {
        return array(
            'nestedForm' => '24',
        );
    }

}