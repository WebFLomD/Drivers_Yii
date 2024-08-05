<?php

namespace app\controllers;

use app\models\Autoparts;
use app\models\AutoPartsSearchForm;
use app\models\ConditionAutoParts;
use app\models\ForModels;
use app\models\Manufacturer;
use app\models\OriginalityAutoParts;
use app\models\ProductAvailability;
use app\models\search\AutopartsSearch;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AutopartsController implements the CRUD actions for Autoparts model.
 */
class AutopartsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['create', 'update', 'delete'],
                    'rules' => [
                        [
                            'actions' => ['create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Autoparts models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AutopartsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $query = Autoparts::find();
        $count = $query ->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 20]);
        $autoparts = $query ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['date_of_registration_auto_parts' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'autoparts' => $autoparts,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pagination' => $pagination,
        ]);
    }

    public function actionSearch()
    {
        $model = new AutoPartsSearchForm();
        $autoparts = Autoparts::find()->all();

        if ($model->load(Yii::$app->request->post()) && $results = $model->search()) {
            return $this->render('search', [
                'model' => $model,
                'results' => $results,
                'autoparts' => $autoparts,
            ]);
        }

        return $this->render('search', ['model' => $model, 'autoparts' => $autoparts]);
    }

    public function actionPost($id)
    {
        $autoparts = Autoparts::findOne($id);

        if ($autoparts === null) {
            // Если пост не найден, перенаправляем на страницу ошибки 404
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        # Автосчетчик для авторизованых пользователей (2 способ, при обновление страницы, счетчик не набирается, обновляется если зашел в пост первый раз)
        if ($autoparts) {
            $session = Yii::$app->session;
            $session->open();

            $viewedPosts = $session->get('viewedPosts', []);

            if (!in_array($autoparts->id, $viewedPosts) && !Yii::$app->user->isGuest) {
                $autoparts->views_auto_parts += 1;
                $autoparts->save();

                $viewedPosts[] = $autoparts->id;
                $session->set('viewedPosts', $viewedPosts);
            }
            $session->close();
        }

        return $this->render('post', [
            'autoparts' => $autoparts,
        ]);
    }

    /**
     * Displays a single Autoparts model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Autoparts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Autoparts();
        $condition = ConditionAutoParts::find()->all();
        $originality = OriginalityAutoParts::find()->all();
        $manufacturer = Manufacturer::find()->all();
//        $for_models = ForModels::find()->all();
        $product_availability = ProductAvailability::find()->all();

        if ($model->load(Yii::$app->request->post())) {
            // Устанавливаем id пользователя
            $model->id_user = Yii::$app->user->id;

            // Загрузка фото в БД
            $model->photo_auto_parts = UploadedFile::getInstance($model, 'photo_auto_parts');
            $filename = md5(microtime()) . '.' . $model->photo_auto_parts->extension;
            $model->photo_auto_parts->saveAs('all_img/auto_parts/' . $filename);
            $model->photo_auto_parts = $filename;
            $model -> id_for_models = '';

            if ($model->save(false)) {

            }

            return $this->redirect(['/autoparts']);
        }

        return $this->render('create', [
            'model' => $model,
            'condition' => $condition,
            'originality' => $originality,
            'manufacturer' => $manufacturer,
//            'for_models' => $for_models,
            'product_availability' => $product_availability,
        ]);
    }

    /**
     * Updates an existing Autoparts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Autoparts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Autoparts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Autoparts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Autoparts::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
