<?php

namespace app\components;

use Exception;
use Yii;
use yii\rbac\ManagerInterface;


class RBAC
{
    private const DEFAULT_ROLE = 'guest';

    private ?ManagerInterface $authManager = null;

    public function __construct()
    {
        $this->authManager = Yii::$app->authManager;
    }

    /**
     * @throws Exception
     */
    public function giveRoleToUser(): void
    {
        $role = $this->authManager->createRole(self::DEFAULT_ROLE);
        Yii::$app->authManager->assign($role, Yii::$app->db->getLastInsertID());
    }
}
