<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;

class ModifyMenuItems
{
    private StrategyRepository         $strategyRepository;
    private MarketingProcessRepository $marketingProcessRepository;
    private TasksRepository            $tasksRepository;

    public function __construct(StrategyRepository $strategyRepository, MarketingProcessRepository $marketingProcessRepository, TasksRepository $tasksRepository)
    {
        $this->strategyRepository         = $strategyRepository;
        $this->marketingProcessRepository = $marketingProcessRepository;
        $this->tasksRepository            = $tasksRepository;
    }

    function modify_menu_items($menu_items)
    {
        $userID = get_current_user_id();

        $strategyEntity      = $this->strategyRepository->get_one_for_user($userID);
        $marketingPlanEntity = $this->marketingProcessRepository->get_one_for_user($userID);
        $tasksEntity         = $this->tasksRepository->get_one_for_user($userID);

        if (!empty($strategyEntity) && !empty($marketingPlanEntity)) {
            $startCompleted = true;
        } else {
            $startCompleted = false;
        }

        foreach ($menu_items as $menu_item) {

            if ($menu_item->ID == MenuItemIDs::START) {
                if ($startCompleted) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
            if ($menu_item->ID == MenuItemIDs::OVERVIEW_ENTRY) {
                if (!empty($strategyEntity)) {
                    $entryID  = $strategyEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::OVERVIEW . '"]Overview[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                } else {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }

            if ($menu_item->ID == MenuItemIDs::MARKETING_PLAN_ENTRY) {
                if (!empty($marketingPlanEntity)) {
                    $entryID  = $marketingPlanEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::MARKETING_PLAN . '"]Marketing Plan[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                } else {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }

            if ($menu_item->ID == MenuItemIDs::DO_ITEMS) {
                if (!empty($tasksEntity)) {
                    $entryID  = $tasksEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::DO_ITEMS . '"]Do Items[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                } else {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }

            if ($menu_item->ID == MenuItemIDs::ADD) {
                if (!$startCompleted) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
            if ($menu_item->ID == MenuItemIDs::VIEW_UPDATE) {
                if (!$startCompleted) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
        }

        return $menu_items;
    }
}