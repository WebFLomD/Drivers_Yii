<?php

namespace app\controllers;

use app\models\Bodywork;
use app\models\Brandcar;
use app\models\Car;
use app\models\Color;
use app\models\Drivecar;
use app\models\Enginecar;
use app\models\Favourites;
use app\models\Owners;
use app\models\Pts;
use app\models\search\CarSearch;
use app\models\Transmissioncar;
use app\models\Typeofcar;
use app\models\Usedornew;
use app\models\Yearofrelease;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CarController implements the CRUD actions for Car model.
 */
class CarController extends Controller
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
     * Lists all Car models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CarSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Car model.
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
     * Creates a new Car model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Car();

        $bodywork = Bodywork::find()->all();
        $transmission_car = TransmissionCar::find()->all();
        $color = Color::find()->all();
        $drive_car = DriveCar::find()->all();
        $brand_car  = BrandCar::find()->all();
        $engine_car = EngineCar::find()->all();
        $owners = Owners::find()->all();
        $pts = Pts::find()->all();
        $year_of_release = YearOfRelease::find()->all();
        $type_of_car  = TypeOfCar::find()->all();
        $used_or_new = UsedOrNew::find()->all();

        if ($model->load($this->request->post())) {

            # Загрузка поста фото_1 в БД
            $model -> photo_car_1 = UploadedFile::getInstance($model, 'photo_car_1');
            $filename = md5(microtime()) .'.'.$model->photo_car_1->extension;
            $model->photo_car_1->saveAs('all_img/post_car/'.$filename);
            $model->photo_car_1 = $filename;

            # Загрузка поста фото_2 в БД
            $model -> photo_car_2 = UploadedFile::getInstance($model, 'photo_car_2');
            $filename = md5(microtime()) .'.'.$model->photo_car_2->extension;
            $model->photo_car_2->saveAs('all_img/post_car/'.$filename);
            $model->photo_car_2 = $filename;

            # Загрузка поста фото_3 в БД
            $model -> photo_car_3 = UploadedFile::getInstance($model, 'photo_car_3');
            $filename = md5(microtime()) .'.'.$model->photo_car_3->extension;
            $model->photo_car_3->saveAs('all_img/post_car/'.$filename);
            $model->photo_car_3 = $filename;

            # Ставит ID пользователя, который создал пост
            $model -> id_user = Yii::$app->user->id;

            if ($model->save(false)) {

            }

//            return $this->goBack();
            return $this->redirect(['/site/index']);
        }

        return $this->render('create', [
            'model' => $model,

            'bodywork' => $bodywork,
            'transmission_car' => $transmission_car,
            'color' => $color,
            'drive_car' => $drive_car,
            'brand_car' => $brand_car,
            'engine_car' => $engine_car,
            'pts' => $pts,
            'year_of_release' => $year_of_release,
            'type_of_car' => $type_of_car,
            'owners' => $owners,
            'used_or_new' => $used_or_new,
        ]);
    }

    public function actionPost($id)
    {
        $cars = Car::findOne($id);

        if ($cars === null) {
            // Если пост не найден, перенаправляем на страницу ошибки 404
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        # Автосчетчик для авторизованых пользователей (1 способ, но при обновление страницы, счетчик набирается)
//        if ($cars) {
//            if (!Yii::$app->user->isGuest) { // Проверяем, что пользователь авторизован
//                // Получаем текущего авторизованного пользователя
//                $userId = Yii::$app->user->id;
//
//                // Проверяем, просматривал ли пользователь этот пост ранее
//                $viewedPost = Car::findOne(['id_user' => $userId, 'id' => $cars->id]);
//
//                if (!$viewedPost) {
//                    // Увеличиваем счетчик просмотров поста
//                    $cars->views_post += 1;
//                    $cars->save();
//
//                    // Сохраняем информацию о просмотре поста текущим пользователем
//                    $userPostView = new Car();
//                    $userPostView->id_user = $userId;
//                    $userPostView->id = $cars->id;
//                    $userPostView->save();
//                }
//            }
//        }

        # Автосчетчик для авторизованых пользователей (2 способ, при обновление страницы, счетчик не набирается, обновляется если зашел в пост первый раз)
        if ($cars) {
            $session = Yii::$app->session;
            $session->open();

            $viewedPosts = $session->get('viewedPosts', []);

            if (!in_array($cars->id, $viewedPosts) && !Yii::$app->user->isGuest) {
                // Увеличиваем счетчик просмотров без сохранения всей модели
                $cars->updateAttributes(['views_post' => $cars->views_post + 1]);

                $viewedPosts[] = $cars->id;
                $session->set('viewedPosts', $viewedPosts);
            }
            $session->close();
        }

        # Автосчетчик от всех пользователей (3 способ, при обновление страницы, счетчик набирается.
        # Счетчик набирается не смотря какой пользователь (Гость или авторизованый пользователь))
//        if ($cars) {
//            $cars -> views_post += 1;
//            $cars -> save();
//        }

        return $this->render('post',[
            'cars' => $cars,
        ]);
    }

    # Добавление в избранное
    public function actionFavourites($postId)
    {
        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;

            $favourite = new Favourites();
            $favourite->id_car_post = $postId;
            $favourite->id_user = $userId;
            $favourite->save();

            return $this->redirect(Yii::$app->request->referrer);
        }
        // Если гость, его сразу перекидывает страницу "Авторизация"
        else {
            return $this->redirect(['site/login']);
        }
    }

    # Удаление с избранного
    public function actionUnfavourites($postId)
    {
        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;

            Favourites::deleteAll(['id_car_post' => $postId, 'id_user' => $userId]);

            return $this->redirect(Yii::$app->request->referrer);
        }
        // Если гость, его сразу перекидывает страницу "Авторизация"
        else {
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Updates an existing Car model.
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
     * Deletes an existing Car model.
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
     * Finds the Car model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Car the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Car::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
