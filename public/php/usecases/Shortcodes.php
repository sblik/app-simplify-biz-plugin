<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;

class Shortcodes
{
    private StrategyRepository $strategyRepository;

    public function __construct(StrategyRepository $strategyRepository)
    {
        $this->strategyRepository = $strategyRepository;
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
        $user           = get_user_by('ID', $userID);
        $strategyEntity = $this->strategyRepository->get_one_for_user($userID);

        $url   = do_shortcode('[gv_entry_link entry_id="' . $strategyEntity->id . '" view_id="' . ViewIDs::STRATEGY . '"]Overview[/gv_entry_link]');
        $class = esc_attr($atts['class']);

        SMPLFY_Log::info("Strategy Entity: ", $strategyEntity);

        if (!empty($strategyEntity)) {
            $viewLink = '';
            if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                $viewLink = $matches[1];
            }
            SMPLFY_Log::info("View Link: ", $viewLink);

            return "<a href='$viewLink' class='smplfy-heading-link smplfy-bg_strategy'><i class='fa-sharp fa-solid  fa-compass'></i> <h3>Strategy</h3></a>";
        } else {
            return "<a href='/strategy' class='smplfy-heading-link smplfy-bg_strategy'><i class='fa-sharp fa-solid  fa-compass'></i> <h3>Strategy</h3></a>";
        }
    }
}