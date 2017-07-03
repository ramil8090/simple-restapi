<?php
/**
 * Created by PhpStorm.
 * User: hubble
 * Date: 7/1/17
 * Time: 7:42 PM
 */

namespace MySimple\RestApp\Controllers;


use MySimple\RestApp\Core\Controllers\Controller;

class UserController extends Controller
{
    /* Не реализован до конца
    public function logintokenAction()
    {
        $key = (string) $this->context->config->getParams('secretKey');
        $serverName = (string) $this->context->config->getParam('serverName');
        $tokenId    = base64_encode(random_bytes(32));
        $issuedAt   = time();
        $notBefore  = $issuedAt + 10;
        $expire     = $notBefore + 3600;

        $token = array(
            'iat'  => $issuedAt,
            'jti'  => $tokenId,
            'iss'  => $serverName,
            'nbf'  => $notBefore,
            'exp'  => $expire,
            'data' => array(
                'userName'   => 'someUsername',
                'userRole' => 'someRole',
            )
        );

        $jwt = JWT::encode($token, $key);

    }*/

    public function loginAction()
    {
        if(false === $this->context->identity->isGuest()) {
            session_destroy();
        }

        $basic = $this->context->request->getHeader('Authorization')[0];
        if ($basic) {
            $basic = explode(' ', $basic)[1];
            $basic = explode(':', base64_decode($basic));
            //var_dump($basic);die;
            $username = $basic[0];
            $password = $basic[1];

            if($username == 'admin' && $password == 'admin') {
                $_SESSION['authenticated'] = true;
                $_SESSION['userName'] = 'admin';
                $_SESSION['userRole'] = 'user';
                die('login pass');
            }
        }

        header('WWW-Authenticate: Basic realm="Введите логин/пароль"');
        header('HTTP/1.1 401 Unauthorized');
        exit;
    }

}