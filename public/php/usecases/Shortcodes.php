<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;

class Shortcodes
{
    private StrategyRepository         $strategyRepository;
    private MarketingProcessRepository $marketingProcessRepository;
    private TasksRepository            $tasksRepository;
    private ProcessSalesRepository     $processSalesRepository;

    public function __construct(StrategyRepository $strategyRepository, MarketingProcessRepository $marketingProcessRepository, TasksRepository $tasksRepository, ProcessSalesRepository $processSalesRepository)
    {
        $this->strategyRepository         = $strategyRepository;
        $this->marketingProcessRepository = $marketingProcessRepository;
        $this->tasksRepository            = $tasksRepository;
        $this->processSalesRepository     = $processSalesRepository;
    }


    /**
     * @param $atts
     * @return string|null
     */
    function strategy_link_shortcode($atts)
    {
        // Define default attributes and allow overrides
        $atts = shortcode_atts([
            'class' => '',
        ], $atts, 'smplfy_strategy_link_shortcode');


        $userID         = get_current_user_id();
        $strategyEntity = $this->strategyRepository->get_one_for_user($userID);

        $url   = do_shortcode('[gv_entry_link entry_id="' . $strategyEntity->id . '" view_id="' . ViewIDs::STRATEGY . '"]Strategy[/gv_entry_link]');
        $class = esc_attr($atts['class']);


        if (!empty($strategyEntity)) {
            $viewLink = '';
            if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                $viewLink = $matches[1];
            }

            return "<a href='$viewLink' class='smplfy-heading-link smplfy-bg_strategy'><i class='fa-sharp fa-solid  fa-compass'></i> <h3>Strategy</h3></a>";
        } else {
            $url = SITE_URL . '/start/?id=67';
            return "<a href='$url' class='smplfy-heading-link smplfy-bg_strategy'><i class='fa-sharp fa-solid  fa-compass'></i> <h3>Strategy</h3></a>";
        }
    }

    /**
     * @param $atts
     * @return string|null
     */
    function marketing_plan_link_shortcode($atts)
    {
        // Define default attributes and allow overrides
        $atts = shortcode_atts([
            'class' => '',
        ], $atts, 'smplfy_marketing_link_shortcode');


        $userID                 = get_current_user_id();
        $marketingProcessEntity = $this->marketingProcessRepository->get_one_for_user($userID);

        $url   = do_shortcode('[gv_entry_link entry_id="' . $marketingProcessEntity->id . '" view_id="' . ViewIDs::PROCESS_MARKETING . '"]Marketing[/gv_entry_link]');
        $class = esc_attr($atts['class']);


        if (!empty($marketingProcessEntity)) {
            $viewLink = '';
            if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                $viewLink = $matches[1];
            }

            return "<a href='$viewLink' class='smplfy-heading-link smplfy-bg_marketing'><i class='fa-sharp fa-solid  fa-megaphone'></i> <h3>Marketing</h3></a>";
        } else {
            $url = SITE_URL . '/start/?id=80';

            return "<a href='$url' class='smplfy-heading-link smplfy-bg_marketing'><i class='fa-sharp fa-solid  fa-megaphone'></i> <h3>Marketing</h3></a>";
        }
    }

    /**
     * @param $atts
     * @return string|null
     */
    function sales_link_shortcode($atts)
    {
        // Define default attributes and allow overrides
        $atts = shortcode_atts([
            'class' => '',
        ], $atts, 'smplfy_sales_link_shortcode');


        $userID             = get_current_user_id();
        $processSalesEntity = $this->processSalesRepository->get_one_for_user($userID);

        $url   = do_shortcode('[gv_entry_link entry_id="' . $processSalesEntity->id . '" view_id="' . ViewIDs::PROCESS_SALES . '"]Sales[/gv_entry_link]');
        $class = esc_attr($atts['class']);


        if (!empty($strategyEntity)) {
            $viewLink = '';
            if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                $viewLink = $matches[1];
            }

            return "<a href='$viewLink' class='smplfy-heading-link smplfy-bg_sales'><i class='fa-solid fa-handshake'></i> <h3>Sales</h3></a>";
        } else {
            $url = SITE_URL . '/start/?id=91';
            return "<a href='$url' class='smplfy-heading-link smplfy-bg_sales'><i class='fa-solid fa-handshake'></i> <h3>Sales</h3></a>>";
        }
    }

}