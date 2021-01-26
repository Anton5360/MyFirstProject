<?php


namespace app\modules\controllers;


use app\models\entities\CartEntity;
use app\models\entities\UsersEntity;
use app\modules\models\forms\AddProductToCardForm;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CartController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'add' => ['POST'],
                ],
            ],
        ];
    }


    public function actionIndex()
    {
        $this->view->title = Yii::t('app','Cart');
        $dataProvider = new ActiveDataProvider([
            'query' => CartEntity::find()->where(['user_id' => Yii::$app->user->id])
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }




    public function actionAdd(): Response
    {
        $data = new AddProductToCardForm();

        if(!$data->load($this->request->post()) || !$data->validate()){
            $errors = $data->getErrors();
            array_walk_recursive($errors, static function($error){
                Yii::$app->session->addFlash('error', $error);
            });
        }

        $userID = Yii::$app->user->getId();

        $model = CartEntity::findOne(['user_id' => $userID, 'product_id' => $data->productID]);

        if(!$model){
            $model =  new CartEntity();
        }

        $model->user_id = $userID;
        $model->product_id = $data->productID;
        $model->count += $data->count;


        if($model->save()){
            Yii::$app->session->setFlash('success', 'Product was added to card');
        }
        else {
            Yii::$app
                ->session
                ->setFlash(
                    'error',
                    Yii::t('app',"Product can not be added to card")
                );
        }

        return $this->redirect($this->request->getReferrer());
    }

    /**
     * @param int $user_id
     * @param int $product_id
     * @return Response
     * @throws NotFoundHttpException
     * @throws StaleObjectException
     * @throws \Throwable
     */

    public function actionDelete(int $user_id,int $product_id): Response
    {
        $this->findModel($user_id, $product_id)->delete();

        return $this->redirect(['index']);
    }


    protected function findModel(int $userID, int $productID): CartEntity
    {
        $model = CartEntity::findOne(['product_id' => $productID, 'user_id' => $userID]);

        if (!$model) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
        }

        return $model;
    }
}