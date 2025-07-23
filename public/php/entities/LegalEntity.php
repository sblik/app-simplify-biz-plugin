<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $userID
 * @property $organisationName
 * @property $businessStructure
 * @property $businessRegistration
 * @property $complianceRequirements
 * @property $complianceMonitoring
 * @property $contractTemplates
 * @property $contractReviewProcess
 * @property $legalCounsel
 * @property $intellectualPropertyStrategy
 * @property $ipRegistrationPlan
 * @property $dataPrivacyPolicies
 * @property $employeeLegalAgreements
 * @property $riskAssessment
 * @property $riskMitigationPlan
 * @property $disputeResolutionProcess
 * @property $systemsRepeater
 * @property $status
 */
class LegalEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::PROCESS_LEGAL;
    }

    protected function get_property_map(): array
    {
        return array(
            'userID'                       => '2',
            'organisationName'             => '3',
            'businessStructure'            => '6',
            'businessRegistration'         => '11',
            'complianceRequirements'       => '12',
            'complianceMonitoring'         => '13',
            'contractTemplates'            => '14',
            'contractReviewProcess'        => '15',
            'legalCounsel'                 => '16',
            'intellectualPropertyStrategy' => '17',
            'ipRegistrationPlan'           => '18',
            'dataPrivacyPolicies'          => '19',
            'employeeLegalAgreements'      => '20',
            'riskAssessment'               => '21',
            'riskMitigationPlan'           => '22',
            'disputeResolutionProcess'     => '23',
            'systemsRepeater'              => '8',
            'status'                       => '10',
        );
    }
}