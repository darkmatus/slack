<?php

namespace Darkmatus\Slack;

class AttachmentAction
{
    const TYPE_BUTTON = 'button';

    const STYLE_DEFAULT = 'default';
    const STYLE_PRIMARY = 'primary';
    const STYLE_DANGER  = 'danger';

    /**
     * The required name field of the action. The name will be returned to your Action URL.
     *
     * @var string
     */
    private string $name = '';

    /**
     * The required label for the action.
     *
     * @var string
     */
    private string $text = '';

    /**
     * Button style.
     *
     * @var string
     */
    private string $style = '';

    /**
     * The required type of the action.
     *
     * @var string
     */
    private string $type = self::TYPE_BUTTON;

    /**
     * Optional value. It will be sent to your Action URL.
     *
     * @var string
     */
    private string $value = '';

    /**
     * Confirmation field.
     *
     * @var ActionConfirmation
     */
    private ActionConfirmation $confirm;

    /**
     * Instantiate a new AttachmentAction.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes)
    {
        if (isset($attributes['name'])) {
            $this->setName($attributes['name']);
        }

        if (isset($attributes['text'])) {
            $this->setText($attributes['text']);
        }

        if (isset($attributes['style'])) {
            $this->setStyle($attributes['style']);
        }

        if (isset($attributes['type'])) {
            $this->setType($attributes['type']);
        }

        if (isset($attributes['value'])) {
            $this->setValue($attributes['value']);
        }

        if (isset($attributes['confirm'])) {
            $this->setConfirm($attributes['confirm']);
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return AttachmentAction
     */
    public function setName(string $name): AttachmentAction
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     *
     * @return AttachmentAction
     */
    public function setText(string $text): AttachmentAction
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getStyle(): string
    {
        return $this->style;
    }

    /**
     * @param string $style
     *
     * @return AttachmentAction
     */
    public function setStyle(string $style): AttachmentAction
    {
        $this->style = $style;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return AttachmentAction
     */
    public function setType(string $type): AttachmentAction
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return AttachmentAction
     */
    public function setValue(string $value): AttachmentAction
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return ActionConfirmation
     */
    public function getConfirm(): ActionConfirmation
    {
        return $this->confirm;
    }

    /**
     * @param ActionConfirmation|array $confirm
     *
     * @return AttachmentAction
     */
    public function setConfirm(array|ActionConfirmation $confirm): AttachmentAction
    {
        if ($confirm instanceof ActionConfirmation) {
            $this->confirm = $confirm;

            return $this;
        } else {
            $this->confirm = new ActionConfirmation($confirm);

            return $this;
        }
    }

    /**
     * Get the array representation of this attachment action.
     *
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return [
            'name'    => $this->getName(),
            'text'    => $this->getText(),
            'style'   => $this->getStyle(),
            'type'    => $this->getType(),
            'value'   => $this->getValue(),
            'confirm' => $this->getConfirm()->toArray(),
        ];
    }
}
