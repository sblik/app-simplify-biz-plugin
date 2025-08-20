<?php

namespace SMPLFY\appsimplifybiz;

use MeprUser;
use SmplfyCore\SMPLFY_Log;
use function GravityKit\GravityView\Foundation\ThirdParty\Illuminate\Support\e;

class ModifyMenuItems
{
    private StrategyRepository            $strategyRepository;
    private MarketingRepository           $marketingRepository;
    private ActionStepsRepository         $actionStepsRepository;
    private SalesRepository               $salesRepository;
    private LeadershipRepository          $leadershipRepository;
    private OperationsRepository          $operationsRepository;
    private PeopleRepository              $peopleRepository;
    private MoneyRepository               $moneyRepository;
    private ResearchDevelopmentRepository $researchDevelopmentRepository;
    private RiskRepository                $riskRepository;
    private ObjectivesRepository          $objectivesRepository;

    public function __construct(StrategyRepository            $strategyRepository, MarketingRepository $marketingProcessRepository, ActionStepsRepository $actionStepsRepository, SalesRepository $salesRepository, LeadershipRepository $leadershipRepository,
                                OperationsRepository          $operationsRepository,
                                PeopleRepository              $peopleRepository,
                                MoneyRepository               $moneyRepository,
                                ResearchDevelopmentRepository $researchDevelopmentRepository,
                                RiskRepository                $riskRepository, ObjectivesRepository $objectivesRepository)
    {
        $this->strategyRepository            = $strategyRepository;
        $this->marketingRepository           = $marketingProcessRepository;
        $this->actionStepsRepository         = $actionStepsRepository;
        $this->salesRepository               = $salesRepository;
        $this->leadershipRepository          = $leadershipRepository;
        $this->operationsRepository          = $operationsRepository;
        $this->peopleRepository              = $peopleRepository;
        $this->moneyRepository               = $moneyRepository;
        $this->researchDevelopmentRepository = $researchDevelopmentRepository;
        $this->riskRepository                = $riskRepository;
        $this->objectivesRepository          = $objectivesRepository;

    }

    function modify_menu_items($menu_items)
    {
        $userID = get_current_user_id();

        $strategyEntity    = $this->strategyRepository->get_one_for_user($userID);
        $marketingEntity   = $this->marketingRepository->get_one_for_user($userID);
        $salesEntity       = $this->salesRepository->get_one_for_user($userID);
        $operationsEntity  = $this->operationsRepository->get_one_for_user($userID);
        $leadershipEntity  = $this->leadershipRepository->get_one_for_user($userID);
        $peopleEntity      = $this->peopleRepository->get_one_for_user($userID);
        $moneyEntity       = $this->moneyRepository->get_one_for_user($userID);
        $researchEntity    = $this->researchDevelopmentRepository->get_one_for_user($userID);
        $riskEntity        = $this->riskRepository->get_one_for_user($userID);
        $objectivesEntity  = $this->objectivesRepository->get_one_for_user($userID);
        $actionStepsEntity = $this->actionStepsRepository->get_one_for_user($userID);

        if (!empty($strategyEntity) && !empty($marketingEntity)) {
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
            if ($menu_item->ID == MenuItemIDs::COACH_OPERATIONS) {
                get_current_user_id();
                $mepr_user = new MeprUser(get_current_user_id());
                if (!$mepr_user->is_active_on_membership(Memberships::COACH)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
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
                    $menu_item->classes[0] = 'smplfy-hidden';
                }
            }

            if ($menu_item->ID == MenuItemIDs::PROCESS_MARKETING) {
                if (!empty($marketingEntity)) {
                    $entryID  = $marketingEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_MARKETING . '"]Marketing Plan[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                } else {
                    $menu_item->classes[0] = 'smplfy-hidden';
                }
            }
            if ($menu_item->ID == MenuItemIDs::PROCESS) {
                if (empty($leadershipEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                }
            }
            if ($menu_item->ID == MenuItemIDs::PLAN || $menu_item->ID == MenuItemIDs::IMPLEMENT || $menu_item->ID == MenuItemIDs::TRACK || $menu_item->ID == MenuItemIDs::DASHBOARD) {
                if (empty($strategyEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                }
            }

            if ($menu_item->ID == MenuItemIDs::VIEW_OBJECTIVES || $menu_item->ID == MenuItemIDs::ADD_ACTION_STEPS_TAKS) {
                if (empty($strategyEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                }
            }
            if ($menu_item->ID == MenuItemIDs::VIEW_ACTION_STEPS) {
                if (empty($actionStepsEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                }
            }


            if ($menu_item->ID == MenuItemIDs::PROCESS) {
                if (empty($strategyEntity)) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
            if ($menu_item->ID == MenuItemIDs::ACTION_STEPS) {
                if (empty($actionStepsEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                } else {
                    $menu_item->url = SITE_URL . '/strategy/your-action-steps/';
                }
            }

            if ($menu_item->ID == MenuItemIDs::PROCESS_SALES) {
                if (empty($salesEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                } else {
                    $entryID  = $salesEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_SALES . '"]Sales[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                }
            }
            if ($menu_item->ID == MenuItemIDs::PROCESS_LEADERSHIP) {
                if (empty($leadershipEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                } else {
                    $entryID  = $leadershipEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_LEADERSHIP . '"]Leadership[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                }
            }

            if ($menu_item->ID == MenuItemIDs::PROCESS_OPERATIONS) {
                if (empty($operationsEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                } else {
                    $entryID  = $operationsEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_OPERATIONS . '"]Operations[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                }
            }
            if ($menu_item->ID == MenuItemIDs::PROCESS_PEOPLE) {
                if (empty($peopleEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                } else {
                    $entryID  = $peopleEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_PEOPLE . '"]People[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                }
            }
            if ($menu_item->ID == MenuItemIDs::PROCESS_MONEY) {
                if (empty($moneyEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                } else {
                    $entryID  = $moneyEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_MONEY . '"]Money[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                }
            }
            if ($menu_item->ID == MenuItemIDs::PROCESS_RESEARCH_DEVELOPMENT) {
                if (empty($researchEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                } else {
                    $entryID  = $researchEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_RESEARCH_DEVELOPMENT . '"]R&D[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                }
            }
            if ($menu_item->ID == MenuItemIDs::PROCESS_LEGAL) {
                if (empty($riskEntity)) {
                    $menu_item->classes[0] = 'smplfy-hidden';
                } else {
                    $entryID  = $riskEntity->id;
                    $url      = do_shortcode('[gv_entry_link entry_id="' . $entryID . '" view_id="' . ViewIDs::PROCESS_RISK . '"]Legal[/gv_entry_link]');
                    $viewLink = '';
                    if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                        $viewLink = $matches[1];
                    }
                    $menu_item->url = $viewLink;
                }
            }
            if ($menu_item->ID == MenuItemIDs::INVITE) {
                if (empty($strategyEntity)) {
                    $menu_item->title = '';
                    $menu_item->url   = '';
                }
            }
        }


        return $menu_items;
    }
}