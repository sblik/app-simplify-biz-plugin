<?php

namespace SMPLFY\appsimplifybiz;

class ModifyMenuItems
{
    private OverviewRepository      $overviewRepository;
    private MarketingPlanRepository $marketingPlanRepository;

    public function __construct(OverviewRepository $overviewRepository, MarketingPlanRepository $marketingPlanRepository)
    {
        $this->overviewRepository      = $overviewRepository;
        $this->marketingPlanRepository = $marketingPlanRepository;
    }

    function modify_menu_items($menu_items)
    {
        $userID = get_current_user_id();

        $overviewEntity      = $this->overviewRepository->get_one_for_user($userID);
        $marketingPlanEntity = $this->marketingPlanRepository->get_one_for_user($userID);

        foreach ($menu_items as $menu_item) {

            if ($menu_item->ID == MenuItemIDs::START) {
                if (!empty($overviewEntity) && !empty($marketingPlanEntity)) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
            if ($menu_item->ID == MenuItemIDs::OVERVIEW_ENTRY) {
                if (!empty($overviewEntity)) {
                    $menu_item->url = SITE_URL . '/view/overview/entry/' . $overviewEntity->id;
                } else {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
            if ($menu_item->ID == MenuItemIDs::MARKETING_PLAN_ENTRY) {
                if (!empty($marketingPlanEntity)) {
                    $menu_item->url = do_shortcode('[gv_entry_link entry_id="' . $marketingPlanEntity->id . '" view_id="271"]Marketing Plan[/gv_entry_link]');//SITE_URL . '/view/marketing-plan/entry/' . $marketingPlanEntity->id;
                } else {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
        }

        return $menu_items;
    }
}