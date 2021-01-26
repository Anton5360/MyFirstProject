<?php

namespace app\controllers;

use phpDocumentor\Reflection\Types\Mixed_;
use Throwable;
use Yii;
use app\models\entities\ProductsCategoriesEntity;
use app\models\search\ProductCategoriesSearch;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * ProductsCategoriesController implements the CRUD actions for ProductsCategoriesEntity model.
 */
class ProductsCategoriesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex(): string
    {
        $searchModel = new ProductCategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView(int $id): string
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ProductsCategoriesEntity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return Response|string
     */
    public function actionCreate()
    {
        $model = new ProductsCategoriesEntity();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param int $id
     * @return string
     * @throws NotFoundHttpException
     * @throws Throwable
     * @throws StaleObjectException
     */
    public function actionDelete(int $id): string
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     * @return ProductsCategoriesEntity
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id): ProductsCategoriesEntity
    {
        $model = ProductsCategoriesEntity::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $model;
    }
}
