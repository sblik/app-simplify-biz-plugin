<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $userID
 * @property $nameOfTargetMarket
 * @property $demographics
 * @property $behavioursInterests
 * @property $valuesMotivation
 * @property $marketSizeScope
 * @property $opportunities
 */
class TargetMarketRepeaterEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::TARGET_MARKET_REPEATER;
    }

    protected function get_property_map(): array
    {
        return array(
            'userID'              => '9',
            'nameOfTargetMarket'  => '1',
            'demographics'        => '2',
            'behavioursInterests' => '3',
            'valuesMotivation'    => '4',
            'marketSizeScope'     => '5',
            'opportunities'       => '8',
        );
    }
}