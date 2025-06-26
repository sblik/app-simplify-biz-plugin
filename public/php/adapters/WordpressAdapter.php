<?php

namespace SMPLFY\appsimplifybiz;

class WordpressAdapter
{
    private WPHeartbeatExample $wpHeartbeatExample;
    private UserLogin          $userLogin;

    public function __construct(WPHeartbeatExample $wpHeartbeatExample, UserLogin $userLogin)
    {
        $this->wpHeartbeatExample = $wpHeartbeatExample;
        $this->userLogin          = $userLogin;

        $this->register_hooks();
        $this->register_filters();
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
    }
}