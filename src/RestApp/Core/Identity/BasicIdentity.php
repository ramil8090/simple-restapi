<?php
/**
 * Created by PhpStorm.
 * User: hubble
 * Date: 7/1/17
 * Time: 9:16 PM
 */

namespace MySimple\RestApp\Core\Identity;


use MySimple\RestApp\Core\Abstracts\AbstractConfiguration;
use Psr\Log\LoggerInterface;


class BasicIdentity extends Identity
{
    function __construct(AbstractConfiguration $config, LoggerInterface $logger = null)
    {
        parent::__construct($config, $logger);
        $this->verifyByUsernamePassword();
    }

    protected function verifyByUsernamePassword()
    {
        if (isset($_SESSION['authenticated'])) {
            $this->username = $_SESSION['userName'];
            $this->role = $_SESSION['userRole'];
        }
    }

}