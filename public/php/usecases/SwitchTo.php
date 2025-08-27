<?php

namespace SMPLFY\appsimplifybiz;

class SwitchTo
{

    /**
     * @param $atts
     * @return string|null
     */
    function get_switch_to_link_shortcode($atts)
    {

        // Define default attributes and allow overrides
        $atts = shortcode_atts([
            'src'    => '',
            'alt'    => '',
            'width'  => '',
            'height' => '',
            'class'  => '',
            'user'   => '',
        ], $atts, 'smplfy_get_switch_to_link');

        $userID = esc_attr($atts['user']);

        if (empty($userID)) {
            $userID = get_current_user_id();
        }

        $switchToLink = $this->smplfy_switch_to_url($userID);

        return "<div id='switch_to_container'>
        <a href='$switchToLink'>Switch To</a>
</div>";
    }

    /**
     * @param $userID
     * @return string
     */
    function smplfy_switch_to_url($userID): string
    {
        $user = get_user_by('ID', $userID);

        return wp_nonce_url(add_query_arg([
            'action'  => 'switch_to_user',
            'user_id' => $userID,
            'nr'      => 1,
        ], wp_login_url()), "switch_to_user_{$userID}");
    }

    /**
     * @return array|string
     */
    function smplfy_get_switch_to_link($userID): array|string
    {
        return str_replace('&amp;', "&", $this->smplfy_switch_to_url($userID));
    }

}