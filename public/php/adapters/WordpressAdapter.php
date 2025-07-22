<?php

namespace SMPLFY\appsimplifybiz;

class WordpressAdapter
{
    private WPHeartbeatExample $wpHeartbeatExample;
    private UserLogin          $userLogin;
    private ModifyMenuItems    $modifyMenuItems;
    private Shortcodes         $shortcodes;

    public function __construct(WPHeartbeatExample $wpHeartbeatExample, UserLogin $userLogin, ModifyMenuItems $modifyMenuItems, Shortcodes $shortcodes)
    {
        $this->wpHeartbeatExample = $wpHeartbeatExample;
        $this->userLogin          = $userLogin;
        $this->modifyMenuItems    = $modifyMenuItems;
        $this->shortcodes         = $shortcodes;

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

    }

    /**
     * Register Wordpress filters to handle custom logic
     *
     * @return void
     */
    public function register_filters()
    {
        add_filter('heartbeat_received', [$this->wpHeartbeatExample, 'receive_heartbeat'], 10, 2);
        add_filter('login_redirect', [$this->userLogin, 'handle_redirect'], 10, 3);
        add_filter('wp_nav_menu_objects', [$this->modifyMenuItems, 'modify_menu_items']);
    }

    public function register_shortcodes()
    {
        add_shortcode('smplfy_strategy_link_shortcode', [$this->shortcodes, 'strategy_link_shortcode']);
        add_shortcode('smplfy_marketing_link_shortcode', [$this->shortcodes, 'marketing_plan_link_shortcode']);
        add_shortcode('smplfy_sales_link_shortcode', [$this->shortcodes, 'sales_link_shortcode']);
    }
}