<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;

class Checkout
{

    public function __construct()
    {

    }


    function handle_billing_fields($array)
    {
        SMPLFY_Log::info("handle_billing_fields ARRAY: ", $array);
    }

    public function handle_checkout($fields)
    {
        SMPLFY_Log::info("FIelds before change: ", $fields);
        // Add a full name field before the email field
        $fields['billing']['organisation_name'] = array(
            'type'     => 'text',
            'label'    => __('Organisation Name', 'woocommerce'),
            'required' => true,
            'class'    => array('form-row-wide', 'stripe-gateway-checkout-email-field'),
        );
        return $fields;
    }
}