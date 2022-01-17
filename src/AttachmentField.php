<?php

namespace Darkmatus\Slack;

class AttachmentField
{
    /**
     * The required title field of the field.
     *
     * @var string
     */
    private string $title = '';

    /**
     * The required value of the field.
     *
     * @var string
     */
    private string $value = '';

    /**
     * Whether the value is short enough to fit side by side with
     * other values.
     *
     * @var bool
     */
    private bool $short = false;

    /**
     * Instantiate a new AttachmentField.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes)
    {
        if (isset($attributes['title'])) {
            $this->setTitle($attributes['title']);
        }

        if (isset($attributes['value'])) {
            $this->setValue($attributes['value']);
        }

        if (isset($attributes['short'])) {
            $this->setShort($attributes['short']);
        }
    }

    /**
     * Get the title of the field.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Set the title of the field.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): AttachmentField
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of the field.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Set the value of the field.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setValue(string $value): AttachmentField
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get whether this field is short enough for displaying
     * side-by-side with other fields.
     *
     * @return bool
     */
    public function getShort(): bool
    {
        return $this->short;
    }

    /**
     * Set whether this field is short enough for displaying
     * side-by-side with other fields.
     *
     * @param string $value
     *
     * @return $this
     */
    public function setShort(string $value): AttachmentField
    {
        $this->short = (bool) $value;

        return $this;
    }

    /**
     * Get the array representation of this attachment field.
     *
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'title' => $this->getTitle(),
            'value' => $this->getValue(),
            'short' => $this->getShort(),
        ];
    }
}
