<?php

namespace SMPLFY\appsimplifybiz;

class WooCommerceAdapter
{
    private PurchaseCompleted $purchaseCompleted;
    private Checkout          $checkout;

    public function __construct(PurchaseCompleted $purchaseCompleted, Checkout $checkout)
    {
        $this->purchaseCompleted = $purchaseCompleted;
        $this->checkout          = $checkout;

        $this->register_hooks();
        $this->register_filters();
    }

    /**
     * Register gravity forms hooks to handle custom logic
     *
     * @return void
     */
    public function register_hooks()
    {
        add_action('woocommerce_order_status_completed', [$this->purchaseCompleted, 'handle_purchase']);
        add_action('woocommerce_order_status_processing', [$this->purchaseCompleted, 'handle_processing_purchase']);
        add_action('woocommerce_thankyou', [$this->purchaseCompleted, 'handle_thankyou_page']);
        add_action('woocommerce_checkout_billing', [$this->checkout, 'handle_billing_fields']);
    }

    /**
     * Register gravity forms filters to handle custom logic
     *
     * @return void
     */
    public function register_filters()
    {
        add_filter('woocommerce_checkout_fields', [$this->checkout, 'handle_checkout']);

    }
}