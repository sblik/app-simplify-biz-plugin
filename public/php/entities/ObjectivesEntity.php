<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $userID
 * @property $organisationName
 * @property $workflowDescriptions
 * @property $objective
 * @property $pointPerson
 * @property $dueDate
 * @property $time
 * @property $status
 */
class ObjectivesEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::OBJECTIVES;
    }

    protected function get_property_map(): array
    {
        return array(
            'userID'               => '2',
            'organisationName'     => '3',
            'workflowDescriptions' => '4',
            'objective'            => '5',
            'pointPerson'          => '6',
            'dueDate'              => '7',
            'time'                 => '8',
            'status'               => '9',
        );
    }
}