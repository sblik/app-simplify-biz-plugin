<?php

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_Log;

class Shortcodes
{
    private StrategyRepository             $strategyRepository;
    private MarketingProcessRepository     $marketingProcessRepository;
    private TasksRepository                $tasksRepository;
    private ProcessSalesRepository         $processSalesRepository;
    private TargetMarketRepeaterRepository $targetMarketRepeaterRepository;
    private OperationsRepository           $operationsRepository;
    private PeopleRepository               $peopleRepository;
    private MoneyRepository                $moneyRepository;
    private ResearchDevelopmentRepository  $researchDevelopmentRepository;
    private LeadershipRepository           $leadershipRepository;
    private LegalRepository                $legalRepository;

    public function __construct(StrategyRepository            $strategyRepository,
                                MarketingProcessRepository    $marketingProcessRepository, TasksRepository $tasksRepository,
                                                              $processSalesRepository, TargetMarketRepeaterRepository $targetMarketRepeaterRepository, OperationsRepository $operationsRepository,
                                PeopleRepository              $peopleRepository,
                                MoneyRepository               $moneyRepository,
                                ResearchDevelopmentRepository $researchDevelopmentRepository,
                                LeadershipRepository          $leadershipRepository,
                                LegalRepository               $legalRepository)
    {
        $this->strategyRepository             = $strategyRepository;
        $this->marketingProcessRepository     = $marketingProcessRepository;
        $this->tasksRepository                = $tasksRepository;
        $this->processSalesRepository         = $processSalesRepository;
        $this->operationsRepository           = $operationsRepository;
        $this->peopleRepository               = $peopleRepository;
        $this->moneyRepository                = $moneyRepository;
        $this->researchDevelopmentRepository  = $researchDevelopmentRepository;
        $this->leadershipRepository           = $leadershipRepository;
        $this->legalRepository                = $legalRepository;
        $this->targetMarketRepeaterRepository = $targetMarketRepeaterRepository;
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

        $class               = esc_attr($atts['class']);
        $form                = esc_attr($atts['form']);
        $capitalisedFormName = ucfirst(strtolower($form));

        $fontawesome = esc_attr($atts['fontawesome']);
        $userID      = get_current_user_id();

        $form = strtolower($form);

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
            if ($form == 'target market') {
                $entity = $this->targetMarketRepeaterRepository->get_all();
                $viewID = ViewIDs::TARGET_MARKET;
                $formID = FormIds::TARGET_MARKET_REPEATER;
            }
            if ($form == 'operations') {
                $entity = $this->operationsRepository->get_one_for_user($userID);
                $viewID = ViewIDs::PROCESS_OPERATIONS;
                $formID = FormIds::PROCESS_OPERATIONS;
            }
            if ($form == 'people') {
                $entity = $this->peopleRepository->get_one_for_user($userID);
                $viewID = ViewIDs::PROCESS_PEOPLE;
                $formID = FormIds::PROCESS_PEOPLE;
            }
            if ($form == 'money') {
                $entity = $this->moneyRepository->get_one_for_user($userID);
                $viewID = ViewIDs::PROCESS_MONEY;
                $formID = FormIds::PROCESS_MONEY;
            }
            if ($form == 'r&d') {
                $entity              = $this->researchDevelopmentRepository->get_one_for_user($userID);
                $viewID              = ViewIDs::PROCESS_RESEARCH_DEVELOPMENT;
                $formID              = FormIds::PROCESS_RESEARCH_DEVELOPMENT;
                $capitalisedFormName = 'R&D';
            }
            if ($form == 'leadership') {
                $entity = $this->leadershipRepository->get_one_for_user($userID);
                $viewID = ViewIDs::PROCESS_LEADERSHIP;
                $formID = FormIds::PROCESS_LEADERSHIP;
            }
            if ($form == 'legal') {
                $entity = $this->legalRepository->get_one_for_user($userID);
                $viewID = ViewIDs::PROCESS_LEGAL;
                $formID = FormIds::PROCESS_LEGAL;
            }
            return $this->handle_output($entity, $viewID, $class, $fontawesome, $capitalisedFormName, $formID);
        }
        return null;
    }

    /**
     * @param int $viewID
     * @param array $entity
     * @param $matches
     * @param string|null $class
     * @param string|null $fontawesome
     * @param string $capitalisedFormName
     * @param int $formID
     * @return string
     */
    public function handle_output(MarketingProcessEntity|SalesEntity|StrategyEntity|array|null $entity, int $viewID, ?string $class, ?string $fontawesome, string $capitalisedFormName, int $formID): string
    {
        if (!empty($entity)) {
            if ($formID == FormIds::TARGET_MARKET_REPEATER) {
                return "<a href='/view/overview-target-markets/' class='$class'><i class='$fontawesome'></i> <h3>Target Market</h3></a>";
            }

            $url      = do_shortcode('[gv_entry_link entry_id="' . $entity->id . '" view_id="' . $viewID . '"]Strategy[/gv_entry_link]');
            $viewLink = '';
            if (preg_match('/href="([^"]+)"/', $url, $matches)) {
                $viewLink = $matches[1];
            }
            //'smplfy-heading-link smplfy-bg_strategy' 'fa-sharp fa-solid  fa-compass'
            return "<a href='$viewLink' class='$class'><i class='$fontawesome'></i> <h3>$capitalisedFormName</h3></a>";
        } else {
            if ($formID == FormIds::TARGET_MARKET_REPEATER) {
                return "<a href='/' class='$class'><i class='$fontawesome'></i> <h3>Target Market</h3></a>";
            }
            $url = SITE_URL . '/start/?id=' . $formID;
            return "<a href='$url' class='$class'><i class='$fontawesome'></i> <h3>$capitalisedFormName</h3></a>";
        }
    }

}