<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;

class ModifyMenuItems
{
    private StrategyRepository            $strategyRepository;
    private MarketingRepository           $marketingRepository;
    private TasksRepository               $tasksRepository;
    private SalesRepository               $salesRepository;
    private LeadershipRepository          $leadershipRepository;
    private OperationsRepository          $operationsRepository;
    private PeopleRepository              $peopleRepository;
    private MoneyRepository               $moneyRepository;
    private ResearchDevelopmentRepository $researchDevelopmentRepository;
    private LegalRepository               $legalRepository;

    public function __construct(StrategyRepository            $strategyRepository, MarketingRepository $marketingProcessRepository, TasksRepository $tasksRepository, SalesRepository $salesRepository, LeadershipRepository $leadershipRepository,
                                OperationsRepository          $operationsRepository,
                                PeopleRepository              $peopleRepository,
                                MoneyRepository               $moneyRepository,
                                ResearchDevelopmentRepository $researchDevelopmentRepository,
                                LegalRepository               $legalRepository)
    {
        $this->strategyRepository            = $strategyRepository;
        $this->marketingRepository           = $marketingProcessRepository;
        $this->tasksRepository               = $tasksRepository;
        $this->salesRepository               = $salesRepository;
        $this->operationsRepository          = $operationsRepository;
        $this->peopleRepository              = $peopleRepository;
        $this->moneyRepository               = $moneyRepository;
        $this->researchDevelopmentRepository = $researchDevelopmentRepository;
        $this->legalRepository               = $legalRepository;

    }

    function modify_menu_items($menu_items)
    {
        $userID = get_current_user_id();

        $strategyEntity         = $this->strategyRepository->get_one_for_user($userID);
        $marketingProcessEntity = $this->marketingRepository->get_one_for_user($userID);
        $processSalesEntity     = $this->salesRepository->get_one_for_user($userID);

        $tasksEntity = $this->tasksRepository->get_one_for_user($userID);

        if (!empty($strategyEntity) && !empty($marketingProcessEntity)) {
            $startCompleted = true;
        } else {
            $startCompleted = false;
        }

        foreach ($menu_items as $menu_item) {
            SMPLFY_Log::info("MENU ITEM: ", $menu_item);

            if ($menu_item->ID == MenuItemIDs::START) {
                if ($startCompleted) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
            if ($menu_item->ID == MenuItemIDs::STRATEGY) {
                if (!empty($strategyEntity)) {
                    $entryID  = $strategyEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::STRATEGY . '"]Overview[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                } else {
                    $menu_item->url = SITE_URL . '/start/?id=67';
                }
            }

            if ($menu_item->ID == MenuItemIDs::MARKETING_PLAN_ENTRY) {
                if (!empty($marketingProcessEntity)) {
                    $entryID  = $marketingProcessEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_MARKETING . '"]Marketing Plan[/gv_entry_link]');
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

            if ($menu_item->ID == MenuItemIDs::TASKS) {
                if (!empty($tasksEntity)) {
                    $entryID  = $tasksEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::TASKS . '"]Do Items[/gv_entry_link]');
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
            if ($menu_item->ID == MenuItemIDs::MARKETING_PROCESS) {
                if (empty($strategyEntity)) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                } else if (!empty($marketingProcessEntity)) {
                    $entryID  = $marketingProcessEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_MARKETING . '"]Do Items[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                } else {
                    $menu_item->url = SITE_URL . '/start/?id=80';
                }
            }
            if ($menu_item->ID == MenuItemIDs::PROCESS) {
                if (empty($strategyEntity)) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
            if ($menu_item->ID == MenuItemIDs::ACTION_STEPS) {
                if (empty($strategyEntity)) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
            if ($menu_item->ID == MenuItemIDs::PROCESS_SALES) {
                if (empty($processSalesEntity)) {
                    $menu_item->url = SITE_URL . '/start/?id=91';
                } else {
                    $entryID  = $processSalesEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_SALES . '"]Sales[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                }
            }
        }


        return $menu_items;
    }
}