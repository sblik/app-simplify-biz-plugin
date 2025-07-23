<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $userID
 * @property $organisationName
 * @property $blueprintProspectingDialogue
 * @property $blueprintSalesDialogue
 * @property $objectionsResponsesRepeater
 * @property $systemsRepeater
 * @property $status
 */
class SalesEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::PROCESS_SALES;
    }

    protected function get_property_map(): array
    {
        return array(
            'userID'                       => '2',
            'organisationName'             => '3',
            'blueprintProspectingDialogue' => '14',
            'blueprintSalesDialogue'       => '6',
            'objectionsResponsesRepeater'  => '4',
            'systemsRepeater'              => '5',
            'status'                       => '16',
        );
    }
}