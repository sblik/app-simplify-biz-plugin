<?php
/**
 * A factory class responsible for creating and initializing all dependencies used in the plugin
 */

namespace SMPLFY\appsimplifybiz;

use SmplfyCore\SMPLFY_GravityFormsApiWrapper;

class DependencyFactory
{

    /**
     * Create and initialize all dependencies
     *
     * @return void
     */
    static function create_plugin_dependencies()
    {
        $gravityFormsWrapper = new SMPLFY_GravityFormsApiWrapper();

        // Repositories
        $strategyRepository             = new StrategyRepository($gravityFormsWrapper);
        $marketingRepository            = new MarketingRepository($gravityFormsWrapper);
        $tasksRepository                = new ActionStepsRepository($gravityFormsWrapper);
        $processSalesRepository         = new SalesRepository($gravityFormsWrapper);
        $targetMarketRepeaterRepository = new TargetMarketRepeaterRepository($gravityFormsWrapper);

        $operationsRepository          = new OperationsRepository($gravityFormsWrapper);
        $peopleRepository              = new PeopleRepository($gravityFormsWrapper);
        $moneyRepository               = new MoneyRepository($gravityFormsWrapper);
        $researchDevelopmentRepository = new ResearchDevelopmentRepository($gravityFormsWrapper);
        $leadershipRepository          = new LeadershipRepository($gravityFormsWrapper);
        $riskRepository                = new RiskRepository($gravityFormsWrapper);
        $objectivesRepository          = new ObjectivesRepository($gravityFormsWrapper);
        $organisationLookupRepository  = new OrganisationLookupRepository($gravityFormsWrapper);
        $inviteCoachRepository         = new InviteCoachRepository($gravityFormsWrapper);

        //Usecases
        $purchaseCompleted = new PurchaseCompleted();
        $checkout          = new Checkout();
        $userRegistered    = new UserRegistered();
        $userLogin         = new UserLogin($strategyRepository, $marketingRepository);
        $modifyMenuItems   = new ModifyMenuItems($strategyRepository, $marketingRepository, $tasksRepository, $processSalesRepository, $leadershipRepository,
            $operationsRepository,
            $peopleRepository,
            $moneyRepository,
            $researchDevelopmentRepository,
            $riskRepository, $objectivesRepository);
        $shortcodes        = new Shortcodes($strategyRepository, $marketingRepository, $tasksRepository, $processSalesRepository, $targetMarketRepeaterRepository,
            $operationsRepository,
            $peopleRepository,
            $moneyRepository,
            $researchDevelopmentRepository,
            $leadershipRepository,
            $riskRepository, $objectivesRepository, $inviteCoachRepository);
        $signUp            = new SignUp($organisationLookupRepository);
        $coachInvite       = new CoachInvite($inviteCoachRepository);
        $coachAbility      = new CoachAbility($inviteCoachRepository);
        $switchTo          = new SwitchTo();


        new GravityFormsAdapter($userRegistered, $coachInvite, $coachAbility);
        new WordpressAdapter($userLogin, $modifyMenuItems, $shortcodes, $coachAbility, $switchTo);
        new WooCommerceAdapter($purchaseCompleted, $checkout);
        new MemberpressAdapter($userLogin, $signUp);

    }
}