<?php

namespace BlockFactory\BlockBuilder\Actions;

/**
 * Register post meta
 *
 * @since 1.0.0
 */
class RegisterPostMeta
{
    public function __invoke(): void
    {
        $authCallback = static function () {
            return current_user_can('edit_posts');
        };

        $sanitizeInt = static function ($value) {
            return filter_var($value, FILTER_SANITIZE_NUMBER_INT);
        };

        $meta = [
            'bf_LockedLayout' => [
                'show_in_rest'      => true,
                'single'            => true,
                'type'              => 'boolean',
                'auth_callback'     => $authCallback,
                'sanitize_callback' => $sanitizeInt,
                'default'           => false
            ],
        ];

        foreach ($meta as $metaKey => $args) {
            register_post_meta(RegisterPostType::SLUG, $metaKey, $args);
        }
    }
}
