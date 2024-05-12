<?php
function get_github_commits()
{
    $test_token = get_option('test_token');
    $test_url = get_option('test_url');
    $repo_url = $test_url;
    $access_token = $test_token;
    $args = array(
        'headers' => array(
            'Authorization' => 'token ' . $access_token,
        ),
    );

    $response = wp_remote_get($repo_url, $args);

    if (is_wp_error($response)) {
        return false;
    }

    $commits = json_decode(wp_remote_retrieve_body($response), true);

    return $commits;
}
add_action('init', 'get_github_commits');
