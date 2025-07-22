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
    function dashboard_view_link($atts)
    {
        // Define default attributes and allow overrides
        $atts = shortcode_atts([
            'class'       => '',
            'form'        => '',
            'fontawesome' => '',
        ], $atts, 'smplfy_dashboard_view_shortcode');

        $class       = esc_attr($atts['class']);
        $form        = esc_attr($atts['form']);
        $fontawesome = esc_attr($atts['fontawesome']);
        $userID      = get_current_user_id();

        $capitalisedFormName = ucfirst(strtolower($form));


        if (empty($class)) {
            $class = 'smplfy-heading-link';
        }
        if (empty($fontawesome)) {
            $fontawesome = 'fa-solid fa-handshake';
        }

        if (!empty($form)) {
            if ($form == 'strategy') {
                $entity = $this->strategyRepository->get_one_for_user($userID);
                $viewID = ViewIDs::STRATEGY;
                $formID = FormIds::STRATEGY;
            }
            if ($form == 'marketing') {
                $entity = $this->marketingProcessRepository->get_one_for_user($userID);
                $viewID = ViewIDs::PROCESS_MARKETING;
                $formID = FormIds::PROCESS_MARKETING;
            }
            if ($form == 'sales') {
                $entity = $this->processSalesRepository->get_one_for_user($userID);
                $viewID = ViewIDs::PROCESS_SALES;
                $formID = FormIds::PROCESS_SALES;
            }
            return $this->handle_output($entity, $viewID, $class, $fontawesome, $capitalisedFormName, $formID);
        }
        return null;
    }

    /**
     * @param MarketingProcessEntity|ProcessSalesEntity|StrategyEntity|null $entity
     * @param int $viewID
     * @param $matches
     * @param string|null $class
     * @param string|null $fontawesome
     * @param string $capitalisedFormName
     * @param int $formID
     * @return string
     */
    public function handle_output(MarketingProcessEntity|ProcessSalesEntity|StrategyEntity|null $entity, int $viewID, ?string $class, ?string $fontawesome, string $capitalisedFormName, int $formID): string
    {
        if (!empty($entity)) {
            $url      = do_shortcode('[gv_entry_link entry_id="' . $entity->id . '" view_id="' . $viewID . '"]Strategy[/gv_entry_link]');
            $viewLink = '';
            if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                $viewLink = $matches[1];
            }
            //'smplfy-heading-link smplfy-bg_strategy' 'fa-sharp fa-solid  fa-compass'
            return "<a href='$viewLink' class='$class'><i class='$fontawesome'></i> <h3>$capitalisedFormName</h3></a>";
        } else {
            $url = SITE_URL . '/start/?id=' . $formID;
            return "<a href='$url' class='$class'><i class='$fontawesome'></i> <h3>$capitalisedFormName</h3></a>";
        }
    }

}