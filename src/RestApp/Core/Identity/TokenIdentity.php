<?php


namespace MySimple\RestApp\Core\Identity;


use MySimple\RestApp\Core\Abstracts\AbstractConfiguration;
use MySimple\RestApp\Core\Abstracts\AbstractIdentity;
use Psr\Log\LoggerInterface;
use \Firebase\JWT\JWT;
use Vespula\Log\Exception;


class TokenIdentity extends AbstractIdentity
{
    protected $token;
    protected $config;


    function __construct(AbstractConfiguration $config, string $token, LoggerInterface $logger=null)
    {
        parent::__construct($logger);
        $this->token = $token;
        $this->config = $config;
        $this->verifyByToken();
    }


    protected function verifyByToken()
    {
        try
        {
            $key = (string) $this->config->getParam('secretKey');
            $data = (array) JWT::decode($this->token, $key, array('HS256'));
            $this->username = $data['userName'];
            $this->role = $data['userRole'];
        } catch (\UnexpectedValueException $e) {
            $this->logger->error('Wrong token {token}', array('token'=>$this->token));
        }

    }
}