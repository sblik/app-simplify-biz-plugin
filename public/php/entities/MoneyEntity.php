<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $userID
 * @property $organisationName
 * @property $annualBudget
 * @property $departmentalBudget
 * @property $revenueTrackingSystem
 * @property $revenueMonitoringTools
 * @property $expenseCategories
 * @property $expenseApprovalWorkflow
 * @property $costSavingStrategies
 * @property $cashFlowForecast
 * @property $cashReservePlan
 * @property $financialReports
 * @property $stakeHolderReporting
 * @property $complianceRequirements
 * @property $auditSchedule
 * @property $reinvestmentCriteria
 * @property $fundingOptions
 * @property $systemsRepeater
 * @property $status
 */
class MoneyEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::PROCESS_MONEY;
    }

    protected function get_property_map(): array
    {
        return array(
            'userID'                  => '2',
            'organisationName'        => '3',
            'annualBudget'            => '19',
            'departmentalBudget'      => '20',
            'revenueTrackingSystem'   => '4',
            'revenueMonitoringTools'  => '21',
            'expenseCategories'       => '5',
            'expenseApprovalWorkflow' => '6',
            'costSavingStrategies'    => '7',
            'cashFlowForecast'        => '22',
            'cashReservePlan'         => '8',
            'financialReports'        => '9',
            'stakeHolderReporting'    => '10',
            'complianceRequirements'  => '23',
            'auditSchedule'           => '24',
            'reinvestmentCriteria'    => '25',
            'fundingOptions'          => '26',
            'systemsRepeater'         => '12',
            'status'                  => '14',
        );
    }
}