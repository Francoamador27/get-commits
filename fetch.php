<?php
function get_github_commits()
{
    $repo_url = 'https://api.github.com/repos/Francoamador27/github-commit/commits';
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
