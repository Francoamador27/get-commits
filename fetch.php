<?php
function get_github_commits()
{
    $repo_url = 'https://api.github.com/repos/Francoamador27/get-commits/commits';
    $access_token = "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";
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
