<?php
/**
 * An entity represents a Gravity Form and combined with a corresponding Repository can allow for form entry manipulation to be simple and easy to
 * understand when looking at the code
 *
 * @property $nameFirst
 * @property $nameLast
 * @property $email
 */

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_BaseEntity;

/**
 *
 * @property $vipTicketCount
 * @property $expoTicketCount
 * @property $awardsTicketCount
 * @property $classTicketCount
 * @property $roadieTicketCount
 * @property $mealTicketCount
 * @property $nameFirst
 * @property $nameLast
 * @property $email
 */
class AttendeeDashboardEntity extends SMPLFY_BaseEntity
{
    public function __construct($formEntry = array())
    {
        parent::__construct($formEntry);
        $this->formId = FormIds::ATTENDEE_DASHBOARD;
    }

    protected function get_property_map(): array
    {
        return array(
            'vipTicketCount'    => '1',
            'expoTicketCount'   => '3',
            'awardsTicketCount' => '6',
            'classTicketCount'  => '7',
            'roadieTicketCount' => '8',
            'mealTicketCount'   => '9',
            'nameFirst'         => '4.3',
            'nameLast'          => '4.6',
            'email'             => '5',
        );
    }
}