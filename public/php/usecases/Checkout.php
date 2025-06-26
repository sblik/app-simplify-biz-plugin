<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;

class Checkout
{
    private AttendeeDashboardRepository   $attendeeDashboardRepository;
    private InviteGuestRepeaterRepository $inviteGuestRepeaterRepository;

    public function __construct(AttendeeDashboardRepository $attendeeDashboardRepository, InviteGuestRepeaterRepository $inviteGuestRepeaterRepository)
    {
        $this->attendeeDashboardRepository   = $attendeeDashboardRepository;
        $this->inviteGuestRepeaterRepository = $inviteGuestRepeaterRepository;
    }


    function handle_billing_fields($array)
    {
        SMPLFY_Log::info("handle_billing_fields ARRAY: ", $array);
    }

    public function handle_checkout($fields)
    {
        SMPLFY_Log::info("FIelds before change: ", $fields);
        $fields['billing']['billing_email']['priority'] = 10;
        // Add a full name field before the email field
        $fields['billing']['billing_contact_first_name'] = array(
            'type'     => 'text',
            'label'    => __('First Name', 'woocommerce'),
            'required' => true,
            'priority' => 5, // show before email
            'class'    => array('form-row-wide', 'stripe-gateway-checkout-email-field'),
        );
        $fields['billing']['billing_contact_last_name']  = array(
            'type'     => 'text',
            'label'    => __('Last Name', 'woocommerce'),
            'required' => true,
            'priority' => 5, // show before email
            'class'    => array('form-row-wide', 'stripe-gateway-checkout-email-field'),
        );
        $fields['billing']['billing_contact_phone']      = array(
            'type'     => 'text',
            'label'    => __('Phone', 'woocommerce'),
            'required' => true,
            'priority' => 9, // show before email
            'class'    => array('form-row-wide', 'stripe-gateway-checkout-email-field'),
        );


        return $fields;
    }
}