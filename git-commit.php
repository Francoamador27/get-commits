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
    add_submenu_page(
        'git-commit-page', // slug del menú principal
        'Custom Settings', // Título de la página
        'Custom Settings', // Título del menú
        'manage_options',
        'custom-settings',
        'render_custom_settings_page' // Función para mostrar la página
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



//otro codigo

function render_custom_settings_page() {
    // Procesar el formulario si se envió
    if (isset($_POST['test_token'])) {
        // Guardar la variable en la base de datos de WordPress
        update_option('test_token', $_POST['test_token']);
        echo '<div class="updated"><p>Variable saved!</p></div>';
    }
    if (isset($_POST['test_url'])) {
        // Guardar la variable en la base de datos de WordPress
        update_option('test_url', $_POST['test_url']);
        echo '<div class="updated"><p>Variable saved!</p></div>';
    }

    // Obtener el valor guardado de la variable, si existe
    $test_token = get_option('test_token');
    $test_url = get_option('test_url');
    ?>
    <div class="wrap">
        <h1>Custom Settings</h1>
        <form method="post" action="">
            <label for="test_token">Enter Token</label>
            <input type="text" id="test_token" name="test_token" value="<?php echo esc_attr($test_token); ?>">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
        </form>
        <form method="post" action="">
            <label for="test_url">Enter Url</label>
            <input type="text" id="test_url" name="test_url" value="<?php echo esc_attr($test_url); ?>">
            <input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
        </form>
        <?php if (!empty($test_token)) : ?>
            <div class="saved-variable">
                <h2>Your Saved Token:</h2>
                <p><?php echo esc_html($test_token); ?></p>
            </div>
        <?php endif; ?>
        <?php if (!empty($test_url)) : ?>
            <div class="saved-variable">
                <h2>Your Saved URL:</h2>
                <p><?php echo esc_html($test_url); ?></p>
            </div>
        <?php endif; ?>
    </div>
    <?php
}


