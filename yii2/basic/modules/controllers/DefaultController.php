<?php

namespace app\modules\controllers;

use app\models\search\ProductSearch;
use Yii;
use yii\web\Controller;


class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $this->view->title = Yii::t('app','Products');

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index',[
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }
}
