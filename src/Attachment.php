<?php

namespace Darkmatus\Slack;

class Attachment
{
    /**
     * The fallback text to use for clients that don't support attachments.
     *
     * @var ?string
     */
    private ?string $fallback = null;

    /**
     * Optional text that should appear within the attachment.
     *
     * @var ?string
     */
    private ?string $text = null;

    /**
     * Optional image that should appear within the attachment.
     *
     * @var ?string
     */
    private ?string $imageUrl = null;

    /**
     * Optional thumbnail that should appear within the attachment.
     *
     * @var ?string
     */
    private ?string $thumbUrl = null;

    /**
     * Optional text that should appear above the formatted data.
     *
     * @var ?string
     */
    private ?string $pretext = null;

    /**
     * Optional title for the attachment.
     *
     * @var ?string
     */
    private ?string $title = null;

    /**
     * Optional title link for the attachment.
     *
     * @var ?string
     */
    private ?string $titleLink = null;

    /**
     * Optional author name for the attachment.
     *
     * @var ?string
     */
    private ?string $authorName = null;

    /**
     * Optional author link for the attachment.
     *
     * @var ?string
     */
    private ?string $authorLink = null;

    /**
     * Optional author icon for the attachment.
     *
     * @var ?string
     */
    private ?string $authorIcon = null;

    /**
     * The color to use for the attachment.
     *
     * @var ?string
     */
    private ?string $color = 'good';

    /**
     * The text to use for the attachment footer.
     *
     * @var ?string
     */
    private ?string $footer = null;

    /**
     * The icon to use for the attachment footer.
     *
     * @var ?string
     */
    private ?string $footerIcon = null;

    /**
     * The timestamp to use for the attachment.
     *
     * @var \DateTime
     */
    private \DateTime $timestamp;

    /**
     * The fields of the attachment.
     *
     * @var array
     */
    private array $fields = [];

    /**
     * The fields of the attachment that Slack should interpret
     * with its Markdown-like language.
     *
     * @var array
     */
    private array $markdownFields = [];

    /**
     * A collection of actions (buttons) to include in the attachment.
     * A maximum of 5 actions may be provided.
     *
     * @var array
     */
    private array $actions = [];

    /**
     * Instantiate a new Attachment.
     *
     * @param array $attributes
     *
     * @return void
     */
    public function __construct(array $attributes)
    {
        if (isset($attributes['fallback'])) {
            $this->setFallback($attributes['fallback']);
        }

        if (isset($attributes['text'])) {
            $this->setText($attributes['text']);
        }

        if (isset($attributes['image_url'])) {
            $this->setImageUrl($attributes['image_url']);
        }

        if (isset($attributes['thumb_url'])) {
            $this->setThumbUrl($attributes['thumb_url']);
        }

        if (isset($attributes['pretext'])) {
            $this->setPretext($attributes['pretext']);
        }

        if (isset($attributes['color'])) {
            $this->setColor($attributes['color']);
        }

        if (isset($attributes['footer'])) {
            $this->setFooter($attributes['footer']);
        }

        if (isset($attributes['footer_icon'])) {
            $this->setFooterIcon($attributes['footer_icon']);
        }

        if (isset($attributes['timestamp'])) {
            $this->setTimestamp($attributes['timestamp']);
        }

        if (isset($attributes['fields'])) {
            $this->setFields($attributes['fields']);
        }

        if (isset($attributes['mrkdwn_in'])) {
            $this->setMarkdownFields($attributes['mrkdwn_in']);
        }

        if (isset($attributes['title'])) {
            $this->setTitle($attributes['title']);
        }

        if (isset($attributes['title_link'])) {
            $this->setTitleLink($attributes['title_link']);
        }

        if (isset($attributes['author_name'])) {
            $this->setAuthorName($attributes['author_name']);
        }

        if (isset($attributes['author_link'])) {
            $this->setAuthorLink($attributes['author_link']);
        }

        if (isset($attributes['author_icon'])) {
            $this->setAuthorIcon($attributes['author_icon']);
        }

        if (isset($attributes['actions'])) {
            $this->setActions($attributes['actions']);
        }
    }

    /**
     * Get the fallback text.
     *
     * @return ?string
     */
    public function getFallback(): ?string
    {
        return $this->fallback;
    }

    /**
     * Set the fallback text.
     *
     * @param string $fallback
     *
     * @return $this
     */
    public function setFallback(string $fallback): Attachment
    {
        $this->fallback = $fallback;

        return $this;
    }

    /**
     * Get the optional text to appear within the attachment.
     *
     * @return ?string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set the optional text to appear within the attachment.
     *
     * @param string $text
     *
     * @return $this
     */
    public function setText(string $text): Attachment
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the optional image to appear within the attachment.
     *
     * @return ?string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * Set the optional image to appear within the attachment.
     *
     * @param string $imageUrl
     *
     * @return $this
     */
    public function setImageUrl(string $imageUrl): Attachment
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get the optional thumbnail to appear within the attachment.
     *
     * @return ?string
     */
    public function getThumbUrl(): ?string
    {
        return $this->thumbUrl;
    }

    /**
     * Set the optional thumbnail to appear within the attachment.
     *
     * @param string $thumbUrl
     *
     * @return $this
     */
    public function setThumbUrl(string $thumbUrl): Attachment
    {
        $this->thumbUrl = $thumbUrl;

        return $this;
    }

    /**
     * Get the text that should appear above the formatted data.
     *
     * @return ?string
     */
    public function getPretext(): ?string
    {
        return $this->pretext;
    }

    /**
     * Set the text that should appear above the formatted data.
     *
     * @param string $pretext
     *
     * @return $this
     */
    public function setPretext(string $pretext): Attachment
    {
        $this->pretext = $pretext;

        return $this;
    }

    /**
     * Get the color to use for the attachment.
     *
     * @return ?string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Set the color to use for the attachment.
     *
     * @param string $color
     *
     * @return $this
     */
    public function setColor(string $color): Attachment
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the footer to use for the attachment.
     *
     * @return ?string
     */
    public function getFooter(): string
    {
        return $this->footer;
    }

    /**
     * Set the footer text to use for the attachment.
     *
     * @param string $footer
     *
     * @return $this
     */
    public function setFooter(string $footer): Attachment
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * Get the footer icon to use for the attachment.
     *
     * @return ?string
     */
    public function getFooterIcon(): ?string
    {
        return $this->footerIcon;
    }

    /**
     * Set the footer icon to use for the attachment.
     *
     * @param string $footerIcon
     *
     * @return $this
     */
    public function setFooterIcon(string $footerIcon): Attachment
    {
        $this->footerIcon = $footerIcon;

        return $this;
    }

    /**
     * Get the timestamp to use for the attachment.
     *
     * @return \DateTime
     */
    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }

    /**
     * Set the timestamp to use for the attachment.
     *
     * @param \DateTime|string $timestamp
     *
     * @return $this
     */
    public function setTimestamp(\DateTime|string $timestamp): Attachment
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get the title to use for the attachment.
     *
     * @return ?string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Set the title to use for the attachment.
     *
     * @param string $title
     *
     * @return $this
     */
    public function setTitle(string $title): Attachment
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the title link to use for the attachment.
     *
     * @return ?string
     */
    public function getTitleLink(): ?string
    {
        return $this->titleLink;
    }

    /**
     * Set the title link to use for the attachment.
     *
     * @param string $titleLink
     *
     * @return $this
     */
    public function setTitleLink(string $titleLink): Attachment
    {
        $this->titleLink = $titleLink;

        return $this;
    }

    /**
     * Get the author name to use for the attachment.
     *
     * @return ?string
     */
    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    /**
     * Set the author name to use for the attachment.
     *
     * @param string $authorName
     *
     * @return $this
     */
    public function setAuthorName(string $authorName): Attachment
    {
        $this->authorName = $authorName;

        return $this;
    }

    /**
     * Get the author link to use for the attachment.
     *
     * @return ?string
     */
    public function getAuthorLink(): ?string
    {
        return $this->authorLink;
    }

    /**
     * Set the author link to use for the attachment.
     *
     * @param string $authorLink
     *
     * @return $this
     */
    public function setAuthorLink(string $authorLink): Attachment
    {
        $this->authorLink = $authorLink;

        return $this;
    }

    /**
     * Get the author icon to use for the attachment.
     *
     * @return ?string
     */
    public function getAuthorIcon(): ?string
    {
        return $this->authorIcon;
    }

    /**
     * Set the author icon to use for the attachment.
     *
     * @param string $authorIcon
     *
     * @return $this
     */
    public function setAuthorIcon(string $authorIcon): Attachment
    {
        $this->authorIcon = $authorIcon;

        return $this;
    }

    /**
     * Get the fields for the attachment.
     *
     * @return AttachmentField[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * Set the fields for the attachment.
     *
     * @param array<string,mixed> $fields
     *
     * @return $this
     */
    public function setFields(array $fields): Attachment
    {
        $this->clearFields();

        foreach ($fields as $field) {
            $this->addField($field);
        }

        return $this;
    }

    /**
     * Add a field to the attachment.
     *
     * @param array<string,mixed>|\Darkmatus\Slack\AttachmentField $field
     *
     * @return $this
     */
    public function addField(array|AttachmentField $field): Attachment
    {
        if ($field instanceof AttachmentField) {
            $this->fields[] = $field;

            return $this;
        } else {
            $this->fields[] = new AttachmentField($field);

            return $this;
        }
    }

    /**
     * Clear the fields for the attachment.
     *
     * @return $this
     */
    public function clearFields(): Attachment
    {
        $this->fields = [];

        return $this;
    }

    /**
     * Clear the actions for the attachment.
     *
     * @return $this
     */
    public function clearActions(): Attachment
    {
        $this->actions = [];

        return $this;
    }

    /**
     * Get the fields Slack should interpret in its
     * Markdown-like language.
     *
     * @return array<string,mixed>
     */
    public function getMarkdownFields(): array
    {
        return $this->markdownFields;
    }

    /**
     * Set the fields Slack should interpret in its
     * Markdown-like language.
     *
     * @param array<string,mixed> $fields
     *
     * @return $this
     */
    public function setMarkdownFields(array $fields): Attachment
    {
        $this->markdownFields = $fields;

        return $this;
    }

    /**
     * Get the collection of actions (buttons) to include in the attachment.
     *
     * @return AttachmentAction[]
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * Set the collection of actions (buttons) to include in the attachment.
     *
     * @param array<string,mixed> $actions
     *
     * @return Attachment
     */
    public function setActions(array $actions): Attachment
    {
        $this->clearActions();

        foreach ($actions as $action) {
            $this->addAction($action);
        }

        return $this;
    }

    /**
     * Add an action to the attachment.
     *
     * @param array|\Darkmatus\Slack\AttachmentAction $action
     *
     * @return $this
     */
    public function addAction(array|AttachmentAction $action): Attachment
    {
        if ($action instanceof AttachmentAction) {
            $this->actions[] = $action;

            return $this;
        } else {
            $this->actions[] = new AttachmentAction($action);

            return $this;
        }
    }

    /**
     * Convert this attachment to its array representation.
     *
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        $data = [
            'fallback'    => $this->getFallback(),
            'text'        => $this->getText(),
            'pretext'     => $this->getPretext(),
            'color'       => $this->getColor(),
            'footer'      => $this->getFooter(),
            'footer_icon' => $this->getFooterIcon(),
            'ts'          => $this?->getTimestamp()?->getTimestamp(),
            'mrkdwn_in'   => $this->getMarkdownFields(),
            'image_url'   => $this->getImageUrl(),
            'thumb_url'   => $this->getThumbUrl(),
            'title'       => $this->getTitle(),
            'title_link'  => $this->getTitleLink(),
            'author_name' => $this->getAuthorName(),
            'author_link' => $this->getAuthorLink(),
            'author_icon' => $this->getAuthorIcon(),
        ];

        $data['fields']  = $this->getFieldsAsArrays();
        $data['actions'] = $this->getActionsAsArrays();

        return $data;
    }

    /**
     * Iterates over all fields in this attachment and returns
     * them in their array form.
     *
     * @return array
     */
    private function getFieldsAsArrays(): array
    {
        $fields = [];

        /** @var \Darkmatus\Slack\AttachmentField $field */
        foreach ($this->getFields() as $field) {
            $fields[] = $field->toArray();
        }

        return $fields;
    }

    /**
     * Iterates over all actions in this attachment and returns
     * them in their array form.
     *
     * @return array<int, array<string,mixed>>
     */
    private function getActionsAsArrays(): array
    {
        $actions = [];
        foreach ($this->getActions() as $action) {
            $actions[] = $action->toArray();
        }

        return $actions;
    }
}
