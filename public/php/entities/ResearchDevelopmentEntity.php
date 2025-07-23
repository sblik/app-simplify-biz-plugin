<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $userID
 * @property $organisationName
 * @property $ideaCollectionChannels
 * @property $innovationWorkshops
 * @property $ideaEvaluationCriteria
 * @property $swotAnalysis
 * @property $prototypeDevelopment
 * @property $customerTestingPlan
 * @property $randdTeamAndBudget
 * @property $projectManagementTools
 * @property $feedbackIntegration
 * @property $iterationPlan
 * @property $implementationRoadmap
 * @property $departmentCoordination
 * @property $patentableInnovation
 * @property $ipDocumentation
 * @property $systemsRepeater
 * @property $status
 */
class ResearchDevelopmentEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::PROCESS_RESEARCH_DEVELOPMENT;
    }

    protected function get_property_map(): array
    {
        return array(
            'userID'                 => '2',
            'organisationName'       => '3',
            'ideaCollectionChannels' => '4',
            'innovationWorkshops'    => '5',
            'ideaEvaluationCriteria' => '6',
            'swotAnalysis'           => '7',
            'prototypeDevelopment'   => '8',
            'customerTestingPlan'    => '9',
            'randdTeamAndBudget'     => '10',
            'projectManagementTools' => '16',
            'feedbackIntegration'    => '17',
            'iterationPlan'          => '18',
            'implementationRoadmap'  => '19',
            'departmentCoordination' => '20',
            'patentableInnovation'   => '21',
            'ipDocumentation'        => '22',
            'systemsRepeater'        => '12',
            'status'                 => '14',
        );
    }
}