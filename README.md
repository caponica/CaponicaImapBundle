Caponica Imap Bundle
====================

PhpImap integration via a Symfony service.

Installation
------------

Install using [composer](http://getcomposer.org) by adding the following in the `require` section of your `composer.json` file:

``` json
    "require": {
        ...
        "caponica/imap-bundle": "dev-master"
    },
```

Register the bundle in your kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Caponica\ImapBundle\CaponicaImapBundle(),
    );
}
```


Configuration
-------------

The bundle does not add a service to your project by default. To add the service,
you will need to define the parameters and then the service itself.

``` yaml
# app/config/parameters.yml
your_imap_config:
    imapPath:           '{imap.gmail.com:993/imap/ssl}INBOX'
    username:           you@gmail.com
    password:           your_password
    directory:          /path/to/folder
```

``` yaml
# services.yml
    caponica_imap_box:
        class:          Caponica\ImapBundle\Service\CaponicaImap
        calls:
            - [ setConfig, [ %your_imap_config_box% ]]
```


Usage
-----

To access the service, just reference it by the service name you defined above. E.g., from a controller:

    $caponicaImap = $this->container->get('caponica_imap_box');
    $mailbox = $this->caponicaImap->getImapMailbox();
    $mailsIds = $mailbox->sortMails(SORTDATE);
