<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $userID
 * @property $organisationName
 * @property $jobsRoleSkills
 * @property $recruitmentChannels
 * @property $hiringProcess
 * @property $onboardingPlan
 * @property $onboardingTraining
 * @property $trainingPrograms
 * @property $mentorshipPrograms
 * @property $performanceGoals
 * @property $performanceReviewSchedule
 * @property $compensationPackages
 * @property $retentionInitiatives
 * @property $successionPlan
 * @property $leadershipDevelopmentPlans
 * @property $employeeManagementMethods
 * @property $feedbackActionPlan
 * @property $systemsRepeater
 * @property $status
 */
class PeopleEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::PROCESS_PEOPLE;
    }

    protected function get_property_map(): array
    {
        return array(
            'userID'                     => '2',
            'organisationName'           => '3',
            'jobsRoleSkills'             => '4',
            'recruitmentChannels'        => '5',
            'hiringProcess'              => '6',
            'onboardingPlan'             => '7',
            'onboardingTraining'         => '8',
            'trainingPrograms'           => '9',
            'mentorshipPrograms'         => '10',
            'performanceGoals'           => '15',
            'performanceReviewSchedule'  => '16',
            'compensationPackages'       => '17',
            'retentionInitiatives'       => '18',
            'successionPlan'             => '19',
            'leadershipDevelopmentPlans' => '20',
            'employeeManagementMethods'  => '21',
            'feedbackActionPlan'         => '22',
            'systemsRepeater'            => '12',
            'status'                     => '14',
        );
    }
}