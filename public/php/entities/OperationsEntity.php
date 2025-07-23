<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $userID
 * @property $organisationName
 * @property $workflowDescriptions
 * @property $keyActivitiesDependencies
 * @property $requiredResources
 * @property $inventoryManagementProtocols
 * @property $qualityStandards
 * @property $qualityControlMethods
 * @property $standardOperatingProcedures
 * @property $troubleshootingGuide
 * @property $performanceMetrics
 * @property $monitoringTools
 * @property $scalabilitySteps
 * @property $automationOutsourcingPlan
 * @property $operationalRisk
 * @property $contingencyPlans
 * @property $systemsRepeater
 * @property $status
 */
class OperationsEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::PROCESS_OPERATIONS;
    }

    protected function get_property_map(): array
    {
        return array(
            'userID'                       => '2',
            'organisationName'             => '3',
            'workflowDescriptions'         => '4',
            'keyActivitiesDependencies'    => '5',
            'requiredResources'            => '15',
            'inventoryManagementProtocols' => '16',
            'qualityStandards'             => '17',
            'qualityControlMethods'        => '7',
            'standardOperatingProcedures'  => '8',
            'troubleshootingGuide'         => '9',
            'performanceMetrics'           => '10',
            'monitoringTools'              => '18',
            'scalabilitySteps'             => '20',
            'automationOutsourcingPlan'    => '19',
            'operationalRisk'              => '21',
            'contingencyPlans'             => '22',
            'systemsRepeater'              => '12',
            'status'                       => '14',
        );
    }
}