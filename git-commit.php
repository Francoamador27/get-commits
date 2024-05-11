<?php
/*
Plugin Name: Git Commit History
Description: Display Git commit history in WordPress dashboard.
Version: 1.0
Author: Franco Hugo Amador
*/

// Define la función para obtener los commits
include("fetch.php");
include("include_style.php");

// include("settings.php");


function add_git_commit_page()
{
    add_menu_page(
        'Git Commit History',
        'Git Commits',
        'manage_options',
        'git-commit-page',
        'display_git_commits'
    );

}
add_action('admin_menu', 'add_git_commit_page');




function display_git_commits()
{
    $commits = get_github_commits();
    if (isset($commits[0])) {
        echo '<h2>Latest Commits</h2>';
        echo '<table class="commit">';
        echo '<tr><th>Message</th><th>Author</th><th>Date</th></tr>';
        foreach ($commits as $commit) {
            echo '<tr>';
            echo '<td>' . $commit['commit']['message'] . '</td>';
            echo '<td>' . $commit['commit']['author']['name'] . '</td>';
            echo '<td>' . date("Y-m-d H:i:s", strtotime($commit['commit']['author']['date'])) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>Error fetching commits.</p>';
    }
}


