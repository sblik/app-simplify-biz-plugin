<?php

namespace SMPLFY\appsimplifybiz;

use GFAPI;
use SmplfyCore\SMPLFY_Log;
use SmplfyCore\WorkflowStep;
use function wc_get_order;

class PurchaseCompleted
{

    public function __construct()
    {

    }

    function handle_processing_purchase($order_id)
    {
        $order = wc_get_order($order_id);

        $order->update_status('completed');
    }

    function handle_purchase($order_id)
    {
        SMPLFY_Log::info("In woo commerce order complete ----------");
        $site_id = get_current_blog_id(); // or use get_site_url()

        SMPLFY_Log::info("In if site ID is 6 ----------");
        $order = wc_get_order($order_id);


        // Example: Get order data
        $order_total = $order->get_total();

        $items      = $order->get_items(); // Line items
        $totalItems = 0;


    }

    function handle_thankyou_page($order_id)
    {
        $order = wc_get_order($order_id);
        $url   = SITE_URL . '/attendee';
        if (!$order->has_status('failed')) {
            wp_safe_redirect($url);
            exit;
        }
    }


}