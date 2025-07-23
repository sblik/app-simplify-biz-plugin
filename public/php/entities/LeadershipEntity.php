<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $userID
 * @property $organisationName
 * @property $strategyReviewSchedule
 * @property $decisionMakingFramework
 * @property $decisionTools
 * @property $delegationPlan
 * @property $expectationSetting
 * @property $communicationChannels
 * @property $leadershipTraining
 * @property $coachingPrograms
 * @property $leadershipKPI
 * @property $feedbackMechanism
 * @property $changeManagementFramework
 * @property $changeCommunicationPlan
 * @property $systemsRepeater
 * @property $status
 */
class LeadershipEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::PROCESS_LEADERSHIP;
    }

    protected function get_property_map(): array
    {
        return array(
            'userID'                    => '2',
            'organisationName'          => '3',
            'strategyReviewSchedule'    => '4',
            'decisionMakingFramework'   => '5',
            'decisionTools'             => '6',
            'delegationPlan'            => '7',
            'expectationSetting'        => '8',
            'communicationChannels'     => '9',
            'leadershipTraining'        => '10',
            'coachingPrograms'          => '17',
            'leadershipKPI'             => '18',
            'feedbackMechanism'         => '19',
            'changeManagementFramework' => '20',
            'changeCommunicationPlan'   => '21',
            'systemsRepeater'           => '12',
            'status'                    => '14',
        );
    }
}