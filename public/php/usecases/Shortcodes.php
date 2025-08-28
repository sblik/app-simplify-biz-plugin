<?php

namespace SMPLFY\appsimplifybiz;

use Exception;
use SmplfyCore\SMPLFY_Log;
use SmplfyCore\UserActions;
use SmplfyCore\UserMeta;
use WP_User_Query;

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
    private RiskRepository                 $riskRepository;
    private ObjectivesRepository           $objectivesRepository;
    private InviteCoachRepository          $inviteCoachRepository;

    public function __construct(StrategyRepository            $strategyRepository,
                                MarketingRepository           $marketingProcessRepository, ActionStepsRepository $actionStepsRepository,
                                                              $salesRepository, TargetMarketRepeaterRepository $targetMarketRepeaterRepository, OperationsRepository $operationsRepository,
                                PeopleRepository              $peopleRepository,
                                MoneyRepository               $moneyRepository,
                                ResearchDevelopmentRepository $researchDevelopmentRepository,
                                LeadershipRepository          $leadershipRepository,
                                RiskRepository                $riskRepository, ObjectivesRepository $objectivesRepository, InviteCoachRepository $inviteCoachRepository)
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
        $this->riskRepository                 = $riskRepository;
        $this->targetMarketRepeaterRepository = $targetMarketRepeaterRepository;
        $this->objectivesRepository           = $objectivesRepository;
        $this->inviteCoachRepository          = $inviteCoachRepository;
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
            'text'        => '',
        ], $atts, 'smplfy_dashboard_view_shortcode');

        $class               = esc_attr($atts['class']);
        $form                = esc_attr($atts['form']);
        $type                = esc_attr($atts['type']);
        $text                = esc_attr($atts['text']);
        $capitalisedFormName = ucfirst(strtolower($form));

        $fontawesome = esc_attr($atts['fontawesome']);
        $userID      = get_current_user_id();

        $user = get_user_by('ID', $userID);

        $queryUserID = $_GET['client_id'];

        if (UserActions::does_user_have_role($user, Roles::COACH) && !empty($queryUserID)) {
            $isCoach = true;
            $userID  = $_GET['client_id'];
        } else {
            $isCoach = false;
        }

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
                if ($form == 'risk') {
                    $entity = $this->riskRepository->get_one_for_user($userID);
                    $viewID = ViewIDs::PROCESS_RISK;
                    $formID = FormIds::PROCESS_RISK;
                }
                if ($form == 'objectives') {
                    $entity = $this->strategyRepository->get_one_for_user($userID);
                    $viewID = ViewIDs::OBJECTIVES;
                    $formID = FormIds::OBJECTIVES;
                }
                if ($form == 'action_steps') {
                    $entity = $this->objectivesRepository->get_one_for_user($userID); //Use objectives as entity as when it exists, action steps can be seen
                    $viewID = ViewIDs::ACTION_STEPS;
                    $formID = FormIds::ACTION_STEPS;
                }
                if (!empty($viewID)) {
                    return $this->handle_output($entity, $viewID, $class, $fontawesome, $capitalisedFormName, $formID, $type, $text, $isCoach);
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
    public function handle_output(MarketingEntity|SalesEntity|StrategyEntity|OperationsEntity|PeopleEntity|ResearchDevelopmentEntity|MoneyEntity|RiskEntity|LeadershipEntity|ObjectivesEntity|ActionStepsEntity|array|null $entity, int $viewID, ?string $class, ?string $fontawesome, string $capitalisedFormName, int $formID, $type, $text, $isCoach): string
    {
        if (!empty($entity) && $type == '') {
            return $this->view_or_submit_form_link($formID, $class, $fontawesome, $entity, $viewID, $capitalisedFormName, $text);
        } elseif ($type == 'view') {
            if (!empty($entity)) {
                //Return Links to multi page view
                if ($formID == FormIds::OBJECTIVES) {
                    return "<a href='/implement/view-objectives/' class='$class'><i class='$fontawesome'></i> <h3>" . $text . "</h3></a>";
                }
                if ($formID == FormIds::ACTION_STEPS) {
                    return "<a href='/implement/view-action-steps/' class='$class'><i class='$fontawesome'></i> <h3>" . $text . "</h3></a>";
                }
            } elseif ($formID == FormIds::ACTION_STEPS) {
                return $this->hide_action_step_links($fontawesome);
            } else {
                //Hidden element
                return "<a href='/' class='smplfy-hidden'><i class='$fontawesome'></i> <h3>View</h3></a>";
            }
        } else {
            if ($formID == FormIds::TARGET_MARKET_REPEATER) {
                return "<a href='/' class='$class'><i class='$fontawesome'></i> <h3>" . $text . "</h3></a>";
            }
            if ($isCoach) {
                return "<a href='/' class='$class'><i class='$fontawesome'></i> <h3>Not submitted</h3></a>";
            }
            //If all else fails, return link goes to form submission
            $url = SITE_URL . '/start/?id=' . $formID;
            return "<a href='$url' class='$class'><i class='$fontawesome'></i> <h3>$capitalisedFormName </h3><p>Not submitted</p></a>";
        }
    }

    /**
     * @param int $formID
     * @param string|null $class
     * @param string|null $fontawesome
     * @param LeadershipEntity|SalesEntity|ActionStepsEntity|ResearchDevelopmentEntity|ObjectivesEntity|PeopleEntity|MarketingEntity|array|MoneyEntity|RiskEntity|OperationsEntity|StrategyEntity $entity
     * @param int $viewID
     * @param $matches
     * @param string $capitalisedFormName
     * @return string
     */
    public function view_or_submit_form_link(int $formID, ?string $class, ?string $fontawesome, LeadershipEntity|SalesEntity|ActionStepsEntity|ResearchDevelopmentEntity|ObjectivesEntity|PeopleEntity|MarketingEntity|array|MoneyEntity|RiskEntity|OperationsEntity|StrategyEntity $entity, int $viewID, string $capitalisedFormName, $text): string
    {
        if ($formID == FormIds::TARGET_MARKET_REPEATER) {
            return "<a href='/view/overview-target-markets/' class='$class'><i class='$fontawesome'></i> <h3>" . $text . "</h3></a>";
        }

        $url      = do_shortcode('[gv_entry_link entry_id="' . $entity->id . '" view_id="' . $viewID . '"]Strategy[/gv_entry_link]');
        $viewLink = '';
        if (preg_match('/href="([^"]+)"/', $url, $matches)) {
            $viewLink = $matches[1];
        }
        //'smplfy-heading-link smplfy-bg_strategy' 'fa-sharp fa-solid  fa-compass'
        return "<a href='$viewLink' class='$class'><i class='$fontawesome'></i> <h3>$text</h3></a>";
    }

    /**
     * @param string|null $fontawesome
     * @return string
     */
    public function hide_action_step_links(?string $fontawesome): string
    {
        $objectivesEntity = $this->objectivesRepository->get_one_for_user(get_current_user_id());
        if (empty($objectivesEntity)) {
            ?>
            <script>
                jQuery(document).ready(function (jQuery) {
                    jQuery('a[href="/implement/action-steps-and-tasks/"]').addClass("smplfy-hidden");
                    jQuery(".action_steps_heading").addClass("smplfy-hidden");
                });
            </script>
            <?php
        }
        return "<a href='/' class='smplfy-hidden'><i class='$fontawesome'></i> <h3>View</h3></a>";
    }

    /**
     * @param $atts
     * @return string|null
     */
    function coach_clients_shortcode($atts)
    {
        // Define default attributes and allow overrides
        $atts = shortcode_atts([
            'class' => '',
            'form'  => '',
        ], $atts, 'smplfy_coach_filter_shortcode');

        $class = esc_attr($atts['class']);
        $form  = esc_attr($atts['form']);

        $userID           = get_current_user_id();
        $user             = get_user_by('ID', $userID);
        $currentUserEmail = $user->user_email;

        $args = [
            'meta_key'   => UserMetaKeys::COACH_USER_ID,
            'meta_value' => $userID,
            'number'     => 99,
        ];

        $user_query = new WP_User_Query($args);
        if (!empty($user_query->get_results())) {
            $users = $user_query->get_results();
        } else {
            $users = null;
        }
        if (!empty($users)) { ?>
            <div id="coach-clients-container">
                <table class="user-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Organization</th>
                        <th>Link to Entries</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users as $u): ?>
                        <?php
                        $filters = array(InviteCoachEntity::get_field_id('coachEmail') => $currentUserEmail, 'created_by' => $u->ID);


                        $coachInviteEntity = $this->inviteCoachRepository->get_one($filters);
                        $abilities         = $coachInviteEntity->coachPermissions;

                        SMPLFY_Log::info("Coach invite entry: ", $coachInviteEntity);

                        if ($abilities == 'View AND Edit') {
                            $shortcode = '[smplfy_get_switch_to_link user="' . $u->ID . '"]';
                            $output    = do_shortcode($shortcode);
                        } else {
                            $output = "<a href='/dashboard?client_id=$u->ID'>
                                View Dashboard
                            </a>";
                        }

                        $clientOrganisationName = UserMeta::retrieve_user_meta($u->ID, UserMetaKeys::ORGANISATION);

                        // Determine link target for the name
                        if ($atts['link_template'] === 'author') {
                            $href = get_author_posts_url($u->ID);
                        } else {
                            // Custom pattern, e.g. "/member/?user_id=%d"
                            $href = sprintf($atts['link_template'], (int)$u->ID);
                        }
                        ?>
                        <tr>
                            <td>
                                <?php echo esc_html($u->display_name ?: $u->user_nicename); ?>
                            </td>
                            <td>
                                <?php echo $clientOrganisationName ?>
                            </td>
                            <td>
                                <?php echo $output ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php
        } else {
            return "<p>No clients</p>";
        }
    }

    /**
     * @param $atts
     * @return string|null
     */
    function terms_of_service_link($atts)
    {
        // Define default attributes and allow overrides
        $atts = shortcode_atts([
            'class' => '',
            'form'  => '',
        ], $atts, 'smplfy_terms_of_service');

        $class = esc_attr($atts['class']);
        $form  = esc_attr($atts['form']);

        return '<a href="https://app.simplifybiz.com/terms-of-service/">Terms of Service</a>';
    }

    /**
     * @param $atts
     * @return string|null
     */
    function display_organisation_heading($atts): ?string
    {
        // Define default attributes and allow overrides
        $atts = shortcode_atts([
            'class' => '',
        ], $atts, 'smplfy_organisation_name');

        $class = esc_attr($atts['class']);

        $currentUserID = get_current_user_id();
        $queryUserID   = $_GET['client_id'];

        if (!empty($queryUserID)) {
            $organisationName = UserMeta::retrieve_user_meta($queryUserID, UserMetaKeys::ORGANISATION);
        } else {
            $organisationName = UserMeta::retrieve_user_meta($currentUserID, UserMetaKeys::ORGANISATION);
        }
        if (!empty($organisationName)) {
            return '<h2 class="smplfy-center-heading">' . $organisationName . '</h2>';
        } else {
            return null;
        }

    }

    /**
     * @param $atts
     * @return string|null
     */
    function privacy_policy_link($atts)
    {
        // Define default attributes and allow overrides
        $atts = shortcode_atts([
            'class' => '',
            'form'  => '',
        ], $atts, 'smplfy_privacy_policy');

        $class = esc_attr($atts['class']);
        $form  = esc_attr($atts['form']);

        return '<a href="https://app.simplifybiz.com/privacy-policy/">Privacy Policy</a>';
    }
}