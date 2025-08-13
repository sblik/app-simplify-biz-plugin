<?php
/**
 * Adapter for handling Gravity Forms events
 */

namespace SMPLFY\appsimplifybiz;
class GravityFormsAdapter
{
    private UserRegistered $userRegistered;
    private CoachInvite    $coachInvite;
    private CoachAbility   $coachAbility;

    public function __construct(UserRegistered $userRegistered, CoachInvite $coachInvite, CoachAbility $coachAbility)
    {
        $this->userRegistered = $userRegistered;
        $this->coachInvite    = $coachInvite;
        $this->coachAbility   = $coachAbility;

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
        $gform_after_submission = 'gform_after_submission_';
        $gform_pre_submission   = 'gform_pre_submission_';

        add_action($gform_after_submission . FormIds::INVITE_COACH, [$this->coachInvite, 'handle_coach_invite_submission'], 10, 3);
        add_action($gform_after_submission . FormIds::REMOVE_COACH, [$this->coachAbility, 'handle_coach_removal'], 10, 3);

    }

    /**
     * Register gravity forms filters to handle custom logic
     *
     * @return void
     */
    public function register_filters()
    {
        add_filter('gpnf_enable_feed_processing_setting', '__return_true');
    }
}