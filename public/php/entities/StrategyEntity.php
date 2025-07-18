<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $whyStartBusiness
 * @property $whoDoIWantToServeRepeater
 * @property $problemsCustomersExperienceRepeater
 * @property $futureObjectivesRepeater
 * @property $leaderShipNameFirst
 * @property $leaderShipNameLast
 * @property $marketingNameFirst
 * @property $marketingNameLast
 * @property $salesNameFirst
 * @property $salesNameLast
 * @property $operationsNameFirst
 * @property $operationsNameLast
 * @property $systemsNameFirst
 * @property $systemsNameLast
 */
class StrategyEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::OVERVIEW;
    }

    protected function get_property_map(): array
    {
        return array(
            'whyStartBusiness'                    => '32',
            'whoDoIWantToServeRepeater'           => '11',
            'problemsCustomersExperienceRepeater' => '10',
            'futureObjectivesRepeater'            => '35',
            'leaderShipNameFirst'                 => '17.3',
            'leaderShipNameLast'                  => '17.6',
            'marketingNameFirst'                  => '31.3',
            'marketingNameLast'                   => '31.6',
            'salesNameFirst'                      => '18.3',
            'salesNameLast'                       => '18.6',
            'operationsNameFirst'                 => '19.3',
            'operationsNameLast'                  => '19.6',
            'systemsNameFirst'                    => '20.3',
            'systemsNameLast'                     => '20.6',

        );
    }
}