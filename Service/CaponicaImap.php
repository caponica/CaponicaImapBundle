<?php

namespace Caponica\ImapBundle\Service;

use PhpImap\Mailbox;

class CaponicaImap
{
    const CONFIG_KEY_IMAP_PATH  = 'imapPath';
    const CONFIG_KEY_USERNAME   = 'username';
    const CONFIG_KEY_PASSWORD   = 'password';
    const CONFIG_KEY_DIRECTORY  = 'directory';
    const CONFIG_KEY_ENCODING   = 'encoding';

    private $config = [];
    /** @var Mailbox */
    private $imapMailbox;

    public function setConfig($config = []) {
        $requiredConfig = [
            self::CONFIG_KEY_IMAP_PATH,
            self::CONFIG_KEY_USERNAME,
            self::CONFIG_KEY_PASSWORD,
        ];

        foreach ($requiredConfig as $key) {
            if (empty($config[$key])) {
                throw new \InvalidArgumentException("CaponicaImap missing configuration key $key");
            }
        }

        $defaultConfig = [
            self::CONFIG_KEY_DIRECTORY  => null,
            self::CONFIG_KEY_ENCODING   => 'UTF-8',
        ];

        $this->config = array_merge($defaultConfig, $config);
    }

    /**
     * @return Mailbox
     */
    public function getImapMailbox() {
        if(empty($this->imapMailbox)) {
            $this->imapMailbox = new Mailbox(
                $this->config[self::CONFIG_KEY_IMAP_PATH],
                $this->config[self::CONFIG_KEY_USERNAME],
                $this->config[self::CONFIG_KEY_PASSWORD],
                $this->config[self::CONFIG_KEY_DIRECTORY],
                $this->config[self::CONFIG_KEY_ENCODING]
            );
        }
        return $this->imapMailbox;
    }
}