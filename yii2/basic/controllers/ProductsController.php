<?php

namespace app\controllers;

use app\models\forms\AddProductImagesForm;
use Throwable;
use Yii;
use app\models\entities\ProductsEntity;
use app\models\search\ProductSearch;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;


class ProductsController extends Controller
{

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
        $searchModel = new ProductSearch();
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
        $model = $this->findModel($id);

        $this->view->title = $model->title;

        $imagesUploadModel = new AddProductImagesForm();

        $imagesUploadModel->productID = $model->id;

        if ($this->request->isPost) {
            $imagesUploadModel->imageFiles = UploadedFile::getInstances($imagesUploadModel, 'imageFiles');
            $imagesUploadModel->upload();
        }

        return $this->render('view', [
            'model' => $model,
            'imageFiles' => $imagesUploadModel,
        ]);
    }

    /**
     * @param string $url
     * @throws \yii\web\ServerErrorHttpException
     */
    public function actionImage(string $url)
    {
        $storePath = Yii::getAlias('@storage');
        $fullImagePath = "{$storePath}/{$url}";

        $this->response->format = Response::FORMAT_RAW;
        $this->response->stream = fopen($fullImagePath, 'rb');
        if (!is_resource($this->response->stream) ) {
            throw new \yii\web\ServerErrorHttpException('file access failed: permission deny');
        }
        return $this->response->send();
    }

    /**
     * Creates a new ProductsEntity model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return Response|string
     */
    public function actionCreate()
    {
        $model = new ProductsEntity();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductsEntity model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return Response|string
     * @throws NotFoundHttpException if the model cannot be found
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
     * @return Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionDelete(int $id): Response
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * @param int $id
     * @return ProductsEntity
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id): ProductsEntity
    {
        $model = ProductsEntity::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $model;
    }
}
