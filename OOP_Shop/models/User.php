<?php


namespace app\models;


use app\components\App;
use app\components\validators\CompareValidator;
use app\components\validators\StringValidator;
use app\exceptions\DataBaseException;
use app\exceptions\InvalidConfigException;
use app\exceptions\InvalidValidationException;
use Cassandra\Exception\ValidationException;

class User
{
    private array $data = [];
    private ?int $id = null;
    private ? string $login = null;
    private ?string $password = null;
    private ?string $name = null;
//    private ?string $createdAt = null;


    private function rules() : array
    {
        return [
            'name' => [new StringValidator(3,30, 'Name')],
            'login' => [new StringValidator(5,30, 'Login')],
            'password' => [
                new StringValidator(8,30, 'Password'),
                new CompareValidator($this->data, 'password' ,'confirm_password')
            ],
        ];
    }

    /**
     * @param array $data
     * @throws InvalidConfigException
     * @throws InvalidValidationException
     */
    public function load(array $data)
    {
        $this->data = $data;
        $validator = App::get()->validator()->run($data, $this->rules());

        if(!empty($validator->getErrors())){
//            var_dump($validator->getErrors());exit;
//            $info = implode("<br>", $validator->getErrors());
            throw new InvalidValidationException("Invalid params given");
        }

            foreach($validator->getValidData() as $key => $value) {
                $this->{$key} = $value;
            }
//            exit;
    }

    /**
     * @throws InvalidConfigException
     * @throws DataBaseException
     */
    public function createUser()
    {
        $query = App::get()
            ->db()
            ->insert(
            [
                'name' => $this->name,
                'login' => $this->login,
                'password' => $this->password
            ]
        )
            ->into('`users`')
            ->execute();
        var_dump($query);
    }


}