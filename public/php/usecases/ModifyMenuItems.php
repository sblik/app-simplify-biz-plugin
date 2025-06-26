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

        foreach ($menu_items as $menu_item) {

            if ($menu_item->ID == MenuItemIDs::START) {

                $overviewEntity           = $this->overviewRepository->get_one_for_user($userID);
                $marketingPlansRepository = $this->marketingPlanRepository->get_one_for_user($userID);
                
                if (!empty($overviewEntity) && !empty($marketingPlansRepository)) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
        }

        return $menu_items;
    }
}