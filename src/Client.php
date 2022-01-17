<?php

namespace Darkmatus\Slack;

use GuzzleHttp\Client as Guzzle;
use RuntimeException;

class Client
{
    /**
     * The Slack incoming webhook endpoint.
     *
     * @var string
     */
    private string $endpoint = '';

    /**
     * The default channel to send messages to.
     *
     * @var string
     */
    private string $channel = '';

    /**
     * The default username to send messages as.
     *
     * @var string
     */
    private string $username = '';

    /**
     * The default icon to send messages with.
     *
     * @var string
     */
    private string $icon = '';

    /**
     * Whether to link names like @regan or leave
     * them as plain text.
     *
     * @var bool
     */
    private bool $linkNames = false;

    /**
     * Whether Slack should unfurl text-based URLs.
     *
     * @var bool
     */
    private bool $unfurlLinks = false;

    /**
     * Whether Slack should unfurl media URLs.
     *
     * @var bool
     */
    private bool $unfurlMedia = true;

    /**
     * Whether message text should be formatted with Slack's
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
     * The Guzzle HTTP client instance.
     *
     * @var Guzzle
     */
    private Guzzle $guzzle;

    /**
     * Instantiate a new Client.
     *
     * @param string                   $endpoint
     * @param array<int|string, mixed> $attributes
     *
     * @return void
     */
    public function __construct(string $endpoint, array $attributes = [], Guzzle $guzzle = null)
    {
        $this->endpoint = $endpoint;

        if (isset($attributes['channel'])) {
            $this->setDefaultChannel($attributes['channel']);
        }

        if (isset($attributes['username'])) {
            $this->setDefaultUsername($attributes['username']);
        }

        if (isset($attributes['icon'])) {
            $this->setDefaultIcon($attributes['icon']);
        }

        if (isset($attributes['linkNames'])) {
            $this->setLinkNames($attributes['linkNames']);
        }

        if (isset($attributes['unfurlLinks'])) {
            $this->setUnfurlLinks($attributes['unfurlLinks']);
        }

        if (isset($attributes['unfurlMedia'])) {
            $this->setUnfurlMedia($attributes['unfurlMedia']);
        }

        if (isset($attributes['allowMarkdown'])) {
            $this->setAllowMarkdown($attributes['allowMarkdown']);
        }

        if (isset($attributes['markdownInAttachments'])) {
            $this->setMarkdownInAttachments($attributes['markdownInAttachments']);
        }

        $this->guzzle = $guzzle ?: new Guzzle(['base_uri' => $endpoint]);
    }

    /**
     * Pass any unhandled methods through to a new Message
     * instance.
     *
     * @param string                   $name      The name of the method
     * @param array<int|string, mixed> $arguments The method arguments
     *
     * @return \Darkmatus\Slack\Message
     */
    public function __call(string $name, array $arguments): Message
    {
        return call_user_func_array([$this->createMessage(), $name], $arguments);
    }

    /**
     * Get the Slack endpoint.
     *
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Set the Slack endpoint.
     *
     * @param string $endpoint
     *
     * @return void
     */
    public function setEndpoint(string $endpoint): void
    {
        $this->endpoint = $endpoint;
    }

    /**
     * Get the default channel messages will be created for.
     *
     * @return string
     */
    public function getDefaultChannel(): string
    {
        return $this->channel;
    }

    /**
     * Set the default channel messages will be created for.
     *
     * @param string $channel
     *
     * @return void
     */
    public function setDefaultChannel(string $channel): void
    {
        $this->channel = $channel;
    }

    /**
     * Get the default username messages will be created for.
     *
     * @return string
     */
    public function getDefaultUsername(): string
    {
        return $this->username;
    }

    /**
     * Set the default username messages will be created for.
     *
     * @param string $username
     *
     * @return void
     */
    public function setDefaultUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * Get the default icon messages will be created with.
     *
     * @return string
     */
    public function getDefaultIcon(): string
    {
        return $this->icon;
    }

    /**
     * Set the default icon messages will be created with.
     *
     * @param string $icon
     *
     * @return void
     */
    public function setDefaultIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * Get whether messages sent will have names (like @regan)
     * will be converted into links.
     *
     * @return bool
     */
    public function getLinkNames(): bool
    {
        return $this->linkNames;
    }

    /**
     * Set whether messages sent will have names (like @regan)
     * will be converted into links.
     *
     * @param bool $value
     *
     * @return void
     */
    public function setLinkNames(bool $value)
    {
        $this->linkNames = (bool) $value;
    }

    /**
     * Get whether text links should be unfurled.
     *
     * @return bool
     */
    public function getUnfurlLinks(): bool
    {
        return $this->unfurlLinks;
    }

    /**
     * Set whether text links should be unfurled.
     *
     * @param bool $value
     *
     * @return void
     */
    public function setUnfurlLinks(bool $value): void
    {
        $this->unfurlLinks = (bool) $value;
    }

    /**
     * Get whether media links should be unfurled.
     *
     * @return bool
     */
    public function getUnfurlMedia(): bool
    {
        return $this->unfurlMedia;
    }

    /**
     * Set whether media links should be unfurled.
     *
     * @param bool $value
     *
     * @return void
     */
    public function setUnfurlMedia(bool $value): void
    {
        $this->unfurlMedia = (bool) $value;
    }

    /**
     * Get whether message text should be formatted with
     * Slack's Markdown-like language.
     *
     * @return bool
     */
    public function getAllowMarkdown()
    {
        return $this->allowMarkdown;
    }

    /**
     * Set whether message text should be formatted with
     * Slack's Markdown-like language.
     *
     * @param bool $value
     *
     * @return void
     */
    public function setAllowMarkdown(bool $value)
    {
        $this->allowMarkdown = (bool) $value;
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
     * @return void
     */
    public function setMarkdownInAttachments(array $fields)
    {
        $this->markdownInAttachments = $fields;
    }

    /**
     * Create a new message with defaults.
     *
     * @return \Darkmatus\Slack\Message
     */
    public function createMessage()
    {
        $message = new Message($this);
        $message->setChannel($this->getDefaultChannel());
        $message->setUsername($this->getDefaultUsername());
        $message->setIcon($this->getDefaultIcon());
        $message->setAllowMarkdown($this->getAllowMarkdown());
        $message->setMarkdownInAttachments($this->getMarkdownInAttachments());

        return $message;
    }

    /**     * Send a message.
     *
     * @param \Darkmatus\Slack\Message $message
     *
     * @return void
     */
    public function sendMessage(Message $message): void
    {
        $payload = $this->preparePayload($message);

        $encoded = json_encode($payload, JSON_UNESCAPED_UNICODE);

        if ($encoded === false) {
            throw new RuntimeException(sprintf('JSON encoding error %s: %s', json_last_error(), json_last_error_msg()));
        }

        $this->guzzle->post($this->endpoint, ['body' => $encoded]);
    }

    /**
     * Prepares the payload to be sent to the webhook.
     *
     * @param \Darkmatus\Slack\Message $message The message to send
     *
     * @return array<string, mixed>
     */
    public function preparePayload(Message $message): array
    {
        $payload = [
            'text'         => $message->getText(),
            'channel'      => $message->getChannel(),
            'username'     => $message->getUsername(),
            'link_names'   => $this->getLinkNames() ? 1 : 0,
            'unfurl_links' => $this->getUnfurlLinks(),
            'unfurl_media' => $this->getUnfurlMedia(),
            'mrkdwn'       => $message->getAllowMarkdown(),
        ];

        if ($icon = $message->getIcon()) {
            $payload[$message->getIconType()] = $icon;
        }

        $payload['attachments'] = $this->getAttachmentsAsArrays($message);

        return $payload;
    }

    /**
     * Get the attachments in array form.
     *
     * @param \Darkmatus\Slack\Message $message
     *
     * @return array<
     */
    private function getAttachmentsAsArrays(Message $message): array
    {
        $attachments = [];

        foreach ($message->getAttachments() as $attachment) {
            $attachments[] = $attachment->toArray();
        }

        return $attachments;
    }
}
