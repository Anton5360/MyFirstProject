<?php


namespace app\controllers;


use app\components\AbstractController;
use app\components\App;
use app\exceptions\DataBaseException;
use app\exceptions\InvalidConfigException;
use app\exceptions\InvalidValidationException;
use app\exceptions\NotFoundException;
use app\models\User;

class GuestController extends AbstractController
{
    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function actionLogin()
    {
        return App::get()->template()->render('guest/login',['test' => 123], 'layouts/guest');
    }

    /**
     * @return string
     * @throws DataBaseException
     * @throws InvalidConfigException
     * @throws InvalidValidationException
     * @throws NotFoundException
     */
    public function actionRegistration()
    {
        $query = App::get()
            ->db()
            ->delete()
            ->from('users')
            ->where([['login','LIKE', '%ryn%']])
            ->execute();

        var_dump($query);

//        $query = App::get()
//            ->db()
//            ->update('users')
//            ->set(['name' => 'Irina', 'login' => 'Irixa19781730'])
//            ->where([['name', 'LIKE', 'I%']])
//            ->execute();
//        $query = App::get()
//            ->db()
//            ->select(['id', 'created_at'])
//            ->from('users')
//            ->where([
//                ['name', 'NOT NULL', 'AND'],
//                ['name', '=', 'Антон', 'AND'],
//                ['id', 'between', 3, 7, 'AND'],
//                ['id', 'in', 4, 5, 7],
//            ]);
//        var_dump($query->findOne(), $query->findAll());
                exit;
        if(App::get()->request()->isPost()){
            $model = new User();
            $model->load(App::get()->request()->post());
            $model->createUser();
            exit;
        }
        return App::get()->template()->render('guest/registration',['test' => 123], 'layouts/guest');
    }
}