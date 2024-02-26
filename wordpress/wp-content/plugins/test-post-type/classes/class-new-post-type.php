<?php

final class NewPostType {

    private string $post_type = '';
    public string $post_slug = '';
    public array $labels = [];
    public array $taxonomies = [];

    public function __construct( string $post_type, string $post_slug, array $labels, array $taxonomies) {
        $this->post_type = $post_type;
        $this->post_slug = $post_slug;
        $this->labels = $labels;
        $this->taxonomies = $taxonomies;

        add_action('init', array($this, 'newposttype'));
    }

    public function NewPostType(): void {

        $taxonomies = array();
        foreach ($this->taxonomies as $taxonomy) {
            register_taxonomy(
                "{$this->post_type}_{$taxonomy}", $this->post_type, array(
                    'label'              => $taxonomy,
                    'hierarchical'       => true,
                    'query_var'          => true,
                    'show_admin_column'  => true,
                    'show_in_rest'       => true,
                    'rewrite'            => array( 'slug' => "{$this->post_type}_{$taxonomy}" ),
                )
            );
            $taxonomies[] = "{$this->post_type}_{$taxonomy}";
        }

        $args = array(
            'labels'             => $this -> labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'query_var'          => true,
            'capability_type'    => 'post',
            'hierarchical'       => false,
            'menu_position'      => 4,
            'menu_icon'          => 'dashicons-welcome-write-blog',
            'supports'           => [ 'title', 'editor'],
            'rewrite'            => [ 'slug' => "{$this -> post_type}", ],
            'taxonomies'         => $taxonomies,
        );

        register_post_type( $this -> post_type, $args );
    }
}