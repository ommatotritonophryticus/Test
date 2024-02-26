<?php
/**
 * Plugin Name: test-post-type
 * Plugin URI: https://example.com
 * Description: test-post-type
 * Version: 1.0.0
 * Author: ...
 * Author URI: https://example.com
 * License: GPL2
 */

require(__DIR__ . "/classes/class-new-post-type.php");

new NewPostType(
    'test_note', 'test_notes',
    $labels = array(
        'name'           => 'Тестовая запись',
        'singular_name'  => 'Тестовые записи',
        'add_new'        => 'Новая тестовая запись',
        'add_new_item'   => 'Добавить новую тестовую запись',
    ),
    array(
        'tax1',
        'tax2'
    )
);

