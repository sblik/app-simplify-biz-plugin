<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $marketingObjectives
 * @property $marketingChannelsPrimary
 * @property $marketingChannelsRationale
 * @property $onceOffBudget
 * @property $recurringBudget
 * @property $frequency
 * @property $brandMessagingCoreExample
 * @property $brandMessagingTone
 * @property $contentPlan
 * @property $contentPlanFrequency
 * @property $contentPlanTools
 * @property $successMetricsKeyMetrics
 * @property $successMetricsFeedbackPlan
 * @property $ownersResourcesTimeCommitment
 * @property $ownersResourcesSkills
 * @property $ownersResourcesOutsourcingNeeds
 * @property $actionsStepsDetails
 * @property $status
 */
class MarketingProcessEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::MARKETING_PLAN;
    }

    protected function get_property_map(): array
    {
        return array(
            'marketingObjectives'             => '86',
            'marketingChannelsPrimary'        => '107',
            'marketingChannelsRationale'      => '111',
            'onceOffBudget'                   => '179',
            'recurringBudget'                 => '180',
            'frequency'                       => '181',
            'brandMessagingCoreExample'       => '119',
            'brandMessagingTone'              => '116',
            'contentPlan'                     => '122',
            'contentPlanFrequency'            => '126',
            'contentPlanTools'                => '130',
            'successMetricsKeyMetrics'        => '135',
            'successMetricsFeedbackPlan'      => '139',
            'ownersResourcesTimeCommitment'   => '144',
            'ownersResourcesSkills'           => '148',
            'ownersResourcesOutsourcingNeeds' => '152',
            'actionsStepsDetails'             => '157',
            'status'                          => '176',
        );
    }
}