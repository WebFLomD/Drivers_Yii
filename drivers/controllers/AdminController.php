<?php
namespace app\controllers;

use app\models\Brandcar;
use app\models\Car;
use app\models\search\UserSearch;
use app\models\User;
use app\models\UserCite;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class AdminController extends Controller
{
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['index', 'index-brand-car', 'index-user', 'index-post-admin', 'index-user-cite'],
                    'rules' => [
                        [
                            'actions' => ['index', 'index-brand-car', 'index-user', 'index-post-admin', 'index-user-cite'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                return Yii::$app->user->identity->isAdmin();
                            }
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionIndexUser()
    {
        $searchModel = new UserSearch();
        $dataProviders = $searchModel->search($this->request->queryParams);
        $users = User::find()->all();

        return $this->render('index-user',[
            'searchModel' => $searchModel,
            'dataProviders' => $dataProviders,
            'users' => $users,
        ]);
    }

    public function actionIndexPostAdmin()
    {
        $cars = Car::find()->where(['id_status' => 1])->all(); // Сортировка по убыванию поля "date"
        $cars_try = Car::find()->where(['id_status' => 2])->orderBy(['date_of_registration_post_car' => SORT_DESC])->all();
        $cars_false = Car::find()->where(['id_status' => 3])->orderBy(['date_of_registration_post_car' => SORT_DESC])->all();
        return $this->render('index-post-admin',[
            'cars' => $cars,
            'cars_try' => $cars_try,
            'cars_false' => $cars_false,
        ]);
    }

    public function actionAccept($id)
    {
        $car = Car::findOne($id);
        if ($car) {
            $car->updateAttributes(['id_status' => 2]);
            Yii::$app->session->setFlash('success', 'Статус автомобиля успешно обновлен.');
        } else {
            Yii::$app->session->setFlash('error', 'Автомобиль не найден.');
        }
        return $this->redirect(['index-post-admin']);
    }

    public function actionReject($id)
    {
        $car = Car::findOne($id);
        if ($car) {
            $car->updateAttributes(['id_status' => 3]);
            Yii::$app->session->setFlash('success', 'Статус автомобиля успешно обновлен.');
        } else {
            Yii::$app->session->setFlash('error', 'Автомобиль не найден.');
        }
        return $this->redirect(['index-post-admin']);
    }

    public function actionIndexBrandCar()
    {
        $brands = Brandcar::find()->all();

        return $this->render('index-brand-car',
        [
            'brands' => $brands,
        ]);
    }

    public function actionIndexUserCite()
    {
        $cites = UserCite::find()->all();

        return $this->render('index-user-cite',
            [
                'cites' => $cites,
            ]);
    }
}