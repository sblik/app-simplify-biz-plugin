<?php
/**
 * Adapter for handling Gravity Forms events
 */

namespace SMPLFY\appsimplifybiz;
class GravityFormsAdapter
{

    private ExampleUsecase $exampleUsecase;
    private InvitingGuest  $invitingGuest;
    private UserRegistered $userRegistered;

    public function __construct(ExampleUsecase $exampleUsecase, InvitingGuest $invitingGuest, UserRegistered $userRegistered)
    {
        $this->exampleUsecase = $exampleUsecase;
        $this->invitingGuest  = $invitingGuest;
        $this->userRegistered = $userRegistered;

        $this->register_hooks();
        $this->register_filters();
    }

    /**
     * Register gravity forms hooks to handle custom logic
     *
     * @return void
     */
    public function register_hooks()
    {
        if (get_current_blog_id() == SiteIDs::MY_DO_ITEMS) {
            add_action('gform_pre_submission_33', [$this->invitingGuest, 'handle_repeater_pre_submission'], 10, 3);
            add_action('gform_after_submission_33', [$this->invitingGuest, 'handle_repeater_submission'], 10, 2);
            add_action('gform_user_registered', [$this->userRegistered, 'handle_ticket_assigned'], 10, 4);
            add_action('gform_after_submission_1', [$this->invitingGuest, 'handle_parent_submission'], 10, 2);
        }
    }

    /**
     * Register gravity forms filters to handle custom logic
     *
     * @return void
     */
    public function register_filters()
    {
        add_filter('gpnf_enable_feed_processing_setting', '__return_true');
        if (get_current_blog_id() == SiteIDs::MY_DO_ITEMS) {
            add_filter('gform_pre_render_33', [$this->invitingGuest, 'handle_repeater_form_pre_render']);
            //add_filter('gform_pre_render_1', [$this->invitingGuest, 'handle_parent_form_pre_render']);
        }
    }
}