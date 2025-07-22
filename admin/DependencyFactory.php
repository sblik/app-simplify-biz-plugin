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
        $attendeeDashboardRepository    = new AttendeeDashboardRepository($gravityFormsWrapper);
        $inviteGuestRepository          = new InviteGuestRepeaterRepository($gravityFormsWrapper);
        $inviteGuestParentRepository    = new InviteGuestParentRepository($gravityFormsWrapper);
        $strategyRepository             = new StrategyRepository($gravityFormsWrapper);
        $marketingRepository            = new MarketingProcessRepository($gravityFormsWrapper);
        $tasksRepository                = new TasksRepository($gravityFormsWrapper);
        $processSalesRepository         = new ProcessSalesRepository($gravityFormsWrapper);
        $targetMarketRepeaterRepository = new TargetMarketRepeaterRepository($gravityFormsWrapper);
        //Usecases
        $exampleUsecase     = new ExampleUsecase($attendeeDashboardRepository);
        $wpHeartbeatExample = new WPHeartbeatExample($attendeeDashboardRepository);
        $purchaseCompleted  = new PurchaseCompleted($inviteGuestRepository, $inviteGuestParentRepository);
        $invitingGuest      = new InvitingGuest($attendeeDashboardRepository, $inviteGuestRepository);
        $checkout           = new Checkout($attendeeDashboardRepository, $inviteGuestRepository);
        $userRegistered     = new UserRegistered($inviteGuestRepository);
        $userLogin          = new UserLogin($strategyRepository, $marketingRepository);
        $modifyMenuItems    = new ModifyMenuItems($strategyRepository, $marketingRepository, $tasksRepository, $processSalesRepository);
        $shortcodes         = new Shortcodes($strategyRepository, $marketingRepository, $tasksRepository, $processSalesRepository, $targetMarketRepeaterRepository);


        new GravityFormsAdapter($exampleUsecase, $invitingGuest, $userRegistered);
        new WordpressAdapter($wpHeartbeatExample, $userLogin, $modifyMenuItems, $shortcodes);
        new WooCommerceAdapter($purchaseCompleted, $checkout);
        new MemberpressAdapter($userLogin);

    }
}