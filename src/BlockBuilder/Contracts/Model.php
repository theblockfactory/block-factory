<?php

namespace BlockFactory\BlockBuilder\Contracts;

use BlockFactory\Framework\Contracts\Arrayable;
use InvalidArgumentException;

abstract class Model implements Arrayable
{
    /**
     * Block name
     */
    public string $name = '';

    /**
     * Block title
     */
    public string $title = '';

    /**
     * Block description
     */
    public string $description = '';

    /**
     * Block icon
     */
    public string $icon = 'block-default';

    /**
     * Block category
     */
    public string $category = 'block-factory';

    /**
     * Block keywords
     */
    public array $keywords = [];

    /**
     * Block attributes
     */
    public array $attributes = [];

    /**
     * Block meta
     */
    public array $meta = [];

    /**
     * Block textdomain
     */
    public string $textdomain = 'block-factory';

    /**
     * Block content
     */
    public string $content = '';

    /**
     * @var callable
     */
    public $render;


    /**
     * Create a block instance
     */
    abstract public static function make(array $data): self;

    /**
     * Get Block required fields
     */
    abstract public function getRequiredFields(): array;

    /**
     * Render callback function
     */
    abstract public function renderCallback(array $attributes, string $content): string;

    /**
     * Check if class property exist
     */
    public function has(string $name): bool
    {
        return property_exists(__CLASS__, $name);
    }

    /**
     * Get property
     *
     * @param  string  $prop
     * @param  mixed  $fallback
     *
     * @return mixed
     * @throws InvalidArgumentException if property does not exist
     *
     * @since 1.0.0
     *
     */
    public function get(string $prop, $fallback = '')
    {
        if ( ! $this->has($prop)) {
            throw new InvalidArgumentException(
                sprintf('Property %s does not exist', $prop)
            );
        }

        if (empty($this->{$prop})) {
            return $fallback;
        }

        return $this->{$prop};
    }

    /**
     * Set property
     *
     * @param  string  $prop
     * @param  mixed  $value
     *
     * @since 1.0.0
     *
     */
    public function set(string $prop, $value): void
    {
        if ($this->has($prop)) {
            $this->{$prop} = $value;
        }
    }

    /**
     * @param  array  $data
     *
     * @since 1.0.0
     */
    protected function setPropertiesFromArray(array $data): void
    {
        foreach ($data as $property => $value) {
            if ($this->has($property)) {
                $this->set($property, $value);
            }
        }
    }


    /**
     * @param  array  $data
     *
     * @since 1.0.0
     */
    protected function validateArray(array $data): void
    {
        if (array_diff($this->getRequiredFields(), array_keys($data))) {
            throw new InvalidArgumentException(
                sprintf(
                    'To create a %s object, please provide all the required fields: %s',
                    static::class,
                    implode(', ', $this->getRequiredFields())
                )
            );
        }
    }

    /**
     * @param  string  $category
     *
     * @return array
     * @since 1.0.0
     */
    protected function getCategoryFromString(string $category): array
    {
        return [
            'slug'  => $category,
            'title' => str_replace('-', ' ', ucwords($category)),
            'icon'  => '',
        ];
    }

    /**
     * @return array
     * @since 1.0.0
     *
     */
    public function toArray(): array
    {
        return [
            'name'            => $this->name,
            'title'           => $this->title,
            'description'     => $this->description,
            'icon'            => $this->icon,
            'category'        => $this->getCategoryFromString($this->category),
            'keywords'        => $this->keywords,
            'attributes'      => $this->attributes,
            'meta'            => $this->meta,
            'textdomain'      => $this->textdomain,
            'content'         => $this->content,
            'render_callback' => [$this, 'renderCallback'],
        ];
    }
}
