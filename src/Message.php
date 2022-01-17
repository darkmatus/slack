<?php

namespace Darkmatus\Slack;

class Message
{

    /**
     * @var string
     */
    public const ICON_TYPE_URL = 'icon_url';

    /**
     * @var string
     */
    public const ICON_TYPE_EMOJI = 'icon_emoji';

    /**
     * Reference to the Slack client responsible for sending
     * the message.
     *
     * @var \Darkmatus\Slack\Client
     */
    private Client $client;

    /**
     * The text to send with the message.
     *
     * @var string
     */
    private string $text = '';

    /**
     * The channel the message should be sent to.
     *
     * @var string
     */
    private string $channel = '';

    /**
     * The username the message should be sent as.
     *
     * @var string
     */
    private string $username = '';

    /**
     * The URL to the icon to use.
     *
     * @var ?string
     */
    private ?string $icon = null;

    /**
     * The type of icon we are using.
     *
     * @var ?string
     */
    private ?string $iconType = null;

    /**
     * Whether the message text should be interpreted in Slack's
     * Markdown-like language.
     *
     * @var bool
     */
    private bool $allowMarkdown = true;

    /**
     * The attachment fields which should be formatted with
     * Slack's Markdown-like language.
     *
     * @var array
     */
    private array $markdownInAttachments = [];

    /**
     * An array of attachments to send.
     *
     * @var array
     */
    private array $attachments = [];


    /**
     * Instantiate a new Message.
     *
     * @param \Darkmatus\Slack\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the message text.
     *
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Set the message text.
     *
     * @param string $text
     *
     * @return $this
     */
    public function setText(string $text): Message
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get the channel we will post to.
     *
     * @return string
     */
    public function getChannel(): string
    {
        return $this->channel;
    }

    /**
     * Set the channel we will post to.
     *
     * @param string $channel
     *
     * @return $this
     */
    public function setChannel(string $channel): Message
    {
        $this->channel = $channel;

        return $this;
    }

    /**
     * Get the username we will post as.
     *
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the username we will post as.
     *
     * @param string $username
     *
     * @return $this
     */
    public function setUsername(string $username): Message
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the icon (either URL or emoji) we will post as.
     *
     * @return ?string
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * Set the icon (either URL or emoji) we will post as.
     *
     * @param string $icon
     *
     * @return $this
     */
    public function setIcon(string $icon): Message
    {
        if ($icon == null) {
            $this->icon = $this->iconType = null;

            return $this;
        }

        if (mb_substr($icon, 0, 1) == ':' && mb_substr($icon, mb_strlen($icon) - 1, 1) == ':') {
            $this->iconType = self::ICON_TYPE_EMOJI;
        } else {
            $this->iconType = self::ICON_TYPE_URL;
        }

        $this->icon = $icon;

        return $this;
    }

    /**
     * Get the icon type being used, if an icon is set.
     *
     * @return ?string
     */
    public function getIconType(): ?string
    {
        return $this->iconType;
    }

    /**
     * Get whether message text should be formatted with
     * Slack's Markdown-like language.
     *
     * @return bool
     */
    public function getAllowMarkdown(): bool
    {
        return $this->allowMarkdown;
    }

    /**
     * Set whether message text should be formatted with
     * Slack's Markdown-like language.
     *
     * @param bool $value
     *
     * @return $this
     */
    public function setAllowMarkdown(bool $value): Message
    {
        $this->allowMarkdown = $value;

        return $this;
    }

    /**
     * Enable Markdown formatting for the message.
     *
     * @return Message
     */
    public function enableMarkdown(): Message
    {
        $this->setAllowMarkdown(true);
        return $this;
    }

    /**
     * Disable Markdown formatting for the message.
     *
     * @return Message
     */
    public function disableMarkdown(): Message
    {
        $this->setAllowMarkdown(false);
        return $this;
    }

    /**
     * Get the attachment fields which should be formatted
     * in Slack's Markdown-like language.
     *
     * @return array
     */
    public function getMarkdownInAttachments(): array
    {
        return $this->markdownInAttachments;
    }

    /**
     * Set the attachment fields which should be formatted
     * in Slack's Markdown-like language.
     *
     * @param array $fields
     *
     * @return Message
     */
    public function setMarkdownInAttachments(array $fields): Message
    {
        $this->markdownInAttachments = $fields;
        return $this;
    }

    /**
     * Change the name of the user the post will be made as.
     *
     * @param string $username
     *
     * @return $this
     */
    public function from(string $username): Message
    {
        $this->setUsername($username);

        return $this;
    }

    /**
     * Change the channel the post will be made to.
     *
     * @param string $channel
     *
     * @return $this
     */
    public function to(string $channel): Message
    {
        $this->setChannel($channel);

        return $this;
    }

    /**
     * Chainable method for setting the icon.
     *
     * @param string $icon
     *
     * @return $this
     */
    public function withIcon(string $icon): Message
    {
        $this->setIcon($icon);

        return $this;
    }

    /**
     * Add an attachment to the message.
     *
     * @param array|Attachment $attachment
     *
     * @return $this
     */
    public function attach(array|Attachment $attachment): Message
    {
        if ($attachment instanceof Attachment) {
            $this->attachments[] = $attachment;

            return $this;
        } else {
            $attachmentObject = new Attachment($attachment);

            if (!isset($attachment['mrkdwn_in'])) {
                $attachmentObject->setMarkdownFields($this->getMarkdownInAttachments());
            }

            $this->attachments[] = $attachmentObject;

            return $this;
        }
    }

    /**
     * Get the attachments for the message.
     *
     * @return \Darkmatus\Slack\Attachment[]
     */
    public function getAttachments(): array
    {
        return $this->attachments;
    }

    /**
     * Set the attachments for the message.
     *
     * @param array $attachments
     *
     * @return $this
     */
    public function setAttachments(array $attachments): Message
    {
        $this->clearAttachments();

        foreach ($attachments as $attachment) {
            $this->attach($attachment);
        }

        return $this;
    }

    /**
     * Remove all attachments for the message.
     *
     * @return $this
     */
    public function clearAttachments(): Message
    {
        $this->attachments = [];

        return $this;
    }

    /**
     * Send the message.
     *
     * @param ?string $text The text to send
     *
     * @return $this
     */
    public function send(?string $text = null): Message
    {
        if ($text) {
            $this->setText($text);
        }

        $this->client->sendMessage($this);

        return $this;
    }
}
