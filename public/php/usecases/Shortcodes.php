<?php

namespace SMPLFY\appsimplifybiz;

use Exception;
use SmplfyCore\SMPLFY_Log;

class Shortcodes
{
    private StrategyRepository             $strategyRepository;
    private MarketingRepository            $marketingProcessRepository;
    private ActionStepsRepository          $actionStepsRepository;
    private SalesRepository                $salesRepository;
    private TargetMarketRepeaterRepository $targetMarketRepeaterRepository;
    private OperationsRepository           $operationsRepository;
    private PeopleRepository               $peopleRepository;
    private MoneyRepository                $moneyRepository;
    private ResearchDevelopmentRepository  $researchDevelopmentRepository;
    private LeadershipRepository           $leadershipRepository;
    private LegalRepository                $legalRepository;
    private ObjectivesRepository           $objectivesRepository;

    public function __construct(StrategyRepository            $strategyRepository,
                                MarketingRepository           $marketingProcessRepository, ActionStepsRepository $actionStepsRepository,
                                                              $salesRepository, TargetMarketRepeaterRepository $targetMarketRepeaterRepository, OperationsRepository $operationsRepository,
                                PeopleRepository              $peopleRepository,
                                MoneyRepository               $moneyRepository,
                                ResearchDevelopmentRepository $researchDevelopmentRepository,
                                LeadershipRepository          $leadershipRepository,
                                LegalRepository               $legalRepository, ObjectivesRepository $objectivesRepository)
    {
        $this->strategyRepository             = $strategyRepository;
        $this->marketingProcessRepository     = $marketingProcessRepository;
        $this->actionStepsRepository          = $actionStepsRepository;
        $this->salesRepository                = $salesRepository;
        $this->operationsRepository           = $operationsRepository;
        $this->peopleRepository               = $peopleRepository;
        $this->moneyRepository                = $moneyRepository;
        $this->researchDevelopmentRepository  = $researchDevelopmentRepository;
        $this->leadershipRepository           = $leadershipRepository;
        $this->legalRepository                = $legalRepository;
        $this->targetMarketRepeaterRepository = $targetMarketRepeaterRepository;
        $this->objectivesRepository           = $objectivesRepository;
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
            'type'        => '',
        ], $atts, 'smplfy_dashboard_view_shortcode');

        $class               = esc_attr($atts['class']);
        $form                = esc_attr($atts['form']);
        $type                = esc_attr($atts['type']);
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
            try {
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
                    $entity = $this->salesRepository->get_one_for_user($userID);
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
                if ($form == 'randd') {
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
                if ($form == 'objectives') {
                    $entity = $this->objectivesRepository->get_one_for_user($userID);
                    $viewID = ViewIDs::OBJECTIVES;
                    $formID = FormIds::OBJECTIVES;
                }
                if ($form == 'action_steps') {
                    $entity = $this->actionStepsRepository->get_one_for_user($userID);
                    $viewID = ViewIDs::ACTION_STEPS;
                    $formID = FormIds::ACTION_STEPS;
                }
                if (!empty($viewID)) {
                    return $this->handle_output($entity, $viewID, $class, $fontawesome, $capitalisedFormName, $formID, $type);
                }
            } catch (Exception $exception) {
                error_log('Shortcode error: ' . $exception->getMessage()); // Log for debugging

                return '<div class="smplfy-error">An error occurred. Please try again or contact support.</div>';
            }
        }
        return "<div class='$class smplfy-error'>An error occurred. Please try again or contact support.</div>";
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
    public function handle_output(MarketingEntity|SalesEntity|StrategyEntity|OperationsEntity|PeopleEntity|ResearchDevelopmentEntity|MoneyEntity|LegalEntity|LeadershipEntity|ObjectivesEntity|ActionStepsEntity|array|null $entity, int $viewID, ?string $class, ?string $fontawesome, string $capitalisedFormName, int $formID, $type): string
    {
        if (!empty($entity) && $type == '') {
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
        } elseif ($type == 'view') {
            if (!empty($entity)) {
                if ($formID == FormIds::OBJECTIVES) {
                    return "<a href='/implement/view-objectives/' class='$class'><i class='$fontawesome'></i> <h3>View Objectives</h3></a>";
                }
                if ($formID == FormIds::ACTION_STEPS) {
                    return "<a href='/implement/view-action-steps/' class='$class'><i class='$fontawesome'></i> <h3>View Action Steps</h3></a>";
                }
            } elseif ($formID == FormIds::ACTION_STEPS) {
                $objectivesEntity = $this->objectivesRepository->get_one_for_user(get_current_user_id());
                if (empty($objectivesEntity)) {
                    ?>
                    <script>
                        jQuery('a[href="/implement/action-steps-and-tasks/]').addClass("smplfy-hidden");
                        jQuery(".action_steps_heading").addClass("smplfy-hidden");
                    </script>
                    <?php
                }

            } else {
                return "<a href='/' class='smplfy-hidden'><i class='$fontawesome'></i> <h3>View</h3></a>";
            }
        } else {
            if ($formID == FormIds::TARGET_MARKET_REPEATER) {
                return "<a href='/' class='$class'><i class='$fontawesome'></i> <h3>Target Market</h3></a>";
            }
            $url = SITE_URL . '/start/?id=' . $formID;
            return "<a href='$url' class='$class'><i class='$fontawesome'></i> <h3>$capitalisedFormName</h3></a>";
        }
    }

}