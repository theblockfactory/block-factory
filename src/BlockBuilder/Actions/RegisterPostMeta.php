<?php

namespace BlockFactory\BlockBuilder\Actions;

class RegisterPostMeta
{
    /**
     * @since 1.0.0
     */
    public function register(): void
    {
        $authCallback = static function () {
            return current_user_can('edit_posts');
        };

        $meta = [
            [
                'bf_template_lock' => [
                    'show_in_rest'      => true,
                    'type'              => 'string',
                    'single'            => true,
                    'sanitize_callback' => 'sanitize_text_field',
                    'auth_callback'     => $authCallback
                ]
            ]
        ];

        foreach ($meta as $metaKey => $args) {
            register_post_meta(RegisterPostType::SLUG, $metaKey, $args);
        }
    }
}
