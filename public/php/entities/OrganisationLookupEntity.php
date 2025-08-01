<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $userID
 * @property $organisationName
 */
class OrganisationLookupEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::ORGANISATION_LOOKUP;
    }

    protected function get_property_map(): array
    {
        return array(
            'userID'           => '1',
            'organisationName' => '3',
        );
    }
}