<?php


namespace MySimple\RestApp\Core;


use GuzzleHttp\Psr7\Request;
use MySimple\RestApp\Core\Abstracts\AbstractApplication;
use MySimple\RestApp\Core\Identity\BasicIdentity;
use MySimple\RestApp\Core\Identity\TokenIdentity;
use MySimple\RestApp\Core\Routers\Router;
use MySimple\RestApp\Core\Decorators\PermissionsDecorator;
use MySimple\RestApp\Core\Decorators\LoggerDecorator;
use MySimple\RestApp\Core\Services\ActionService;
use MySimple\RestApp\Core\Permissions\Permissions;
use Slim\PDO\Database;
use Vespula\Log\Adapter\ErrorLog;
use Vespula\Log\Log;


class Application extends AbstractApplication
{

    public function run()
    {
        $router = new Router($this->config->getRoutes());

        list(
            $entity,
            $action,
            $params
            ) = $router->find();

        $service = new ActionService($this->logger, $this->context);

        $permissions = new Permissions($this->config->getAcl($entity), $this->logger);

        $service = new PermissionsDecorator($service, $this->logger, $this->context, $permissions);

        $response = $service->exec($entity, $action, $params);

        echo $response;
        exit;
    }

    protected function initLogger()
    {
        $adapter = new ErrorLog(ErrorLog::TYPE_PHP_LOG);
        $this->logger = new Log($adapter);
    }

    protected function initRequest()
    {
        $this->request = new Request(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI'],
            $this->getallheaders(),
            fopen("php://input", "r"), //file_get_contents('php://input'),
            $_SERVER['SERVER_PROTOCOL']
        );
    }

    protected function initContext()
    {
        $db = $this->initDb();
        $identity = new BasicIdentity($this->config, $this->logger); // new TokenIdentity($this->config, $token, $this->logger)
        $this->context = new ApplicationContext(
            $this->config,
            $this->request,
            $db,
            $identity);
        // new ApplicationContext($this->config, $identity, $this->request, $this->logger);
    }

    protected function initDb()
    {
        $db = $this->config->getDb();
        $dsn = $db['dsn'];
        $usr = $db['username'];
        $pwd = $db['password'];

        return new Database($dsn, $usr, $pwd);
    }

    private function getallheaders()
    {
        $headers = array();
        foreach ($_SERVER as $name => $value) {
            if (substr($name, 0, 5) == 'HTTP_') {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
}