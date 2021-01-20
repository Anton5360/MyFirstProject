<?php


namespace app\components;

use app\exceptions\DataBaseException;
use app\exceptions\InvalidConfigException;
use app\exceptions\NotFoundException;
use ReflectionException;

class App
{
    private array $config;
    private static ?App $instance = null;
    private ?Template $template = null;
    private ?User $user = null;
    private ?Request $request = null;
    private ?Validator $validator = null;
    private ?DataBase $db = null;

    private function __construct(array $config)
    {
        $this->config = $config;
    }

    private function __clone()
    {
    }

    /**
     * @param array $config
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws ReflectionException
     */
    public static function init(array $config) : void
    {
        if(self::$instance !== null){
            throw new InvalidConfigException('Application is initialized already');
        }
        self::$instance = new self($config);
        self::$instance->run();
    }

    /**
     * @return static
     * @throws InvalidConfigException
     */
    public static function get() : self
    {
        if(self::$instance === null){
            throw new InvalidConfigException('Application is not initialized yet');
        }
        return self::$instance;
    }

    public function template() : Template
    {
        return $this->template;
    }

    public function user() : User
    {
        return $this->user;
    }

    public function request() : Request
    {
        return $this->request;
    }

    public function validator() : Validator
    {
        return $this->validator;
    }
    public function db() : DataBase
    {
        return $this->db;
    }

    /**
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws ReflectionException
     */
    private function run() : void
    {
        $this
            ->initRequest()
            ->initTemplate()
            ->initUser()
            ->initValidator()
            ->initDB()
            ->initRouter();
    }

    /**
     * @return $this
     * @throws ReflectionException
     * @throws NotFoundException
     */
    private function initRouter() : self
    {
        $dispatcher = new Dispatcher($_SERVER['REQUEST_URI']);
        (new Router($dispatcher));

        return $this;
    }

    /**
     * @return $this
     * @throws DataBaseException
     * @throws InvalidConfigException
     */
    private function initDB() : self
    {
        $host = $this->getConfigValue('components.db.host');
        $user = $this->getConfigValue('components.db.user');
        $password = $this->getConfigValue('components.db.password');
        $name = $this->getConfigValue('components.db.name');

        if(!$host || !$user || !$name || !$password)
        {
            throw new DataBaseException("DB params is required");
        }

        $this->db = new DataBase($name, $user, $password, $host);

        return $this;
    }

    /**
     * @throws InvalidConfigException
     */
    private function initTemplate() : self
    {
        $viewsDir = $this->getConfigValue('components.template.viewsDir');
        $baseLayout = $this->getConfigValue('components.template.baseLayout');
        $this->template = new Template($viewsDir, $baseLayout);
        return $this;
    }

    private function initUser() : self
    {
        $this->user = new User();
        return $this;
    }

    private function initRequest() : self
    {
        $this->request = new Request();
        return $this;
    }

    private function initValidator() : self
    {
        $this->validator = new Validator();
        return $this;
    }

    /**
     * @param string $keys
     * @return string
     * @throws InvalidConfigException
     */
    private function getConfigValue(string $keys) : string
    {
        $explodeKeys = explode('.', $keys);
        $result = $this->config;
        for($i = 0; $i < count($explodeKeys); $i++){
            $result = $result[$explodeKeys[$i]];
        }
        if(!isset($result)){
            throw new InvalidConfigException("Key {$keys} is required");
        }
        return $result;
    }
}