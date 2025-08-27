<?php

namespace SMPLFY\appsimplifybiz;

class WordpressAdapter
{
    private UserLogin       $userLogin;
    private ModifyMenuItems $modifyMenuItems;
    private Shortcodes      $shortcodes;
    private CoachAbility    $coachAbility;
    private SwitchTo        $switchTo;

    public function __construct(UserLogin $userLogin, ModifyMenuItems $modifyMenuItems, Shortcodes $shortcodes, CoachAbility $coachAbility, SwitchTo $switchTo)
    {
        $this->userLogin       = $userLogin;
        $this->modifyMenuItems = $modifyMenuItems;
        $this->shortcodes      = $shortcodes;
        $this->coachAbility    = $coachAbility;
        $this->switchTo        = $switchTo;

        $this->register_hooks();
        $this->register_filters();
        $this->register_shortcodes();
    }

    /**
     * Register Wordpress hooks to handle custom logic
     *
     * @return void
     */
    public function register_hooks()
    {
        add_action('wp_ajax_can_coach_edit_entries', [$this->coachAbility, 'can_coach_edit_entries']);
        add_action('wp_ajax_nopriv_can_coach_edit_entries', [$this->coachAbility, 'can_coach_edit_entries']);

    }

    /**
     * Register Wordpress filters to handle custom logic
     *
     * @return void
     */
    public function register_filters()
    {
        add_filter('login_redirect', [$this->userLogin, 'handle_redirect'], 10, 3);
        add_filter('wp_nav_menu_objects', [$this->modifyMenuItems, 'modify_menu_items']);
    }

    public function register_shortcodes()
    {
        add_shortcode('smplfy_strategy_link_shortcode', [$this->shortcodes, 'strategy_link_shortcode']);
        add_shortcode('smplfy_marketing_link_shortcode', [$this->shortcodes, 'marketing_plan_link_shortcode']);
        add_shortcode('smplfy_sales_link_shortcode', [$this->shortcodes, 'sales_link_shortcode']);
        add_shortcode('smplfy_dashboard_view_shortcode', [$this->shortcodes, 'dashboard_view_link']);
        add_shortcode('smplfy_coach_filter_shortcode', [$this->shortcodes, 'coach_clients_shortcode']);
        add_shortcode('smplfy_terms_of_service', [$this->shortcodes, 'terms_of_service_link']);
        add_shortcode('smplfy_privacy_policy', [$this->shortcodes, 'privacy_policy_link']);
        add_shortcode('smplfy_organisation_name', [$this->shortcodes, 'display_organisation_heading']);
        add_shortcode('smplfy_get_switch_to_link', [$this->switchTo, 'get_switch_to_link_shortcode']);

    }
}