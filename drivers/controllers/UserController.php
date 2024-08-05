<?php

namespace app\controllers;

use app\models\Autoparts;
use app\models\Car;
use app\models\Favourites;
use app\models\User;
use app\models\search\UserSearch;
use app\models\UserCite;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                        'only' => ['create', 'profile', 'update', 'delete'],
                        'rules' => [
                            [
                                'actions' => ['profile', 'update'],
                                'allow' => true,
                                'roles' => ['@'],
                                'matchCallback' => function ($rule, $action) {
                                    return Yii::$app->user->id == Yii::$app->request->get('id');
                                },
                            ],
                            [
                                'actions' => ['update', 'delete'],
                                'allow' => true,
                                'roles' => ['@'],
                                'matchCallback' => function ($rule, $action) {
                                    return Yii::$app->user->identity->isAdmin();
                                },
                            ],
                            [
                                'actions' => ['create'],
                                'allow' => true,
                                'roles' => ['?'],
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionProfile($id)
    {
        $users = User::findOne($id);
        $posts = Car::find()->all();
        $posts_parts = Autoparts::find()->all();

        // Query for cars
        $queryCars = Car::find()->where(['id_user' => $id]);
        $countCars = $queryCars->count();
        $paginationCars = new Pagination(['totalCount' => $countCars, 'pageSize' => 5]);
        $cars = $queryCars->offset($paginationCars->offset)
            ->limit($paginationCars->limit)
            ->orderBy(['date_of_registration_post_car' => SORT_DESC])
            ->all();

        // Query for autoparts
        $queryParts = Autoparts::find()->where(['id_user' => $id]);
        $countParts = $queryParts->count();
        $paginationParts = new Pagination(['totalCount' => $countParts, 'pageSize' => 5]);
        $parts = $queryParts->offset($paginationParts->offset)
            ->limit($paginationParts->limit)
            ->orderBy(['date_of_registration_auto_parts' => SORT_DESC])
            ->all();

        return $this->render('profile', [
            'users' => $users,
            'cars' => $cars,
            'posts' => $posts,
            'parts' => $parts,
            'paginationCars' => $paginationCars,
            'paginationParts' => $paginationParts,
            'posts_parts' => $posts_parts,
        ]);
    }

    public function actionFavourites($id)
    {
        $users = User::findOne($id);
        $posts = Favourites::find()->all();



        $query = Favourites::find()->where(['id_user' => $id]);
        $count = $query->count();
        $delposts = $query -> all();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $cars = $query->offset($pagination->offset)
            ->limit($pagination->limit)
//            ->orderBy(['date_of_registration_post_car' => SORT_DESC]) // Сортировка по убыванию поля "date"
            ->all();

        return $this->render('favourites',[
            'users' => $users,
            'cars' => $cars,
            'posts' => $posts,
            'pagination' => $pagination,
            'delposts' => $delposts,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();
        $cites = UserCite::find()->orderBy(['name_cite' => SORT_ASC])->all();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['/site/login']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'cites' => $cites,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cites = UserCite::find()->all();

        if ($model->load($this->request->post())) {
            $oldImage = $model->img_user; // Сохраняем ссылку на старое изображение

            if ($model->validate()) {
                $newImage = UploadedFile::getInstance($model, 'img_user');

                if ($newImage) {
                    $filename = md5(microtime()) . '.' . $newImage->extension;
                    $newImage->saveAs('all_img/user/' . $filename);
                    $model->img_user = $filename;
                } else {
                    // Если новое изображение не загружено, сохраняем старое изображение
                    $model->img_user = $oldImage;
                }

                if ($model->save()) {
                    // Проверяем и удаляем старое изображение только после успешного сохранения нового
                    if ($newImage && $oldImage && $oldImage !== $model->img_user) {
                        $oldImagePath = Yii::getAlias('@webroot/all_img/user/' . $oldImage);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }

                    return $this->redirect(['profile', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'cites' => $cites,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $user = User::findOne($id);

        $photo = Yii::getAlias('@web/all_img/user/' . $user->img_user);
        if (file_exists($photo)) {
            unlink($photo);
        }

        $user->delete();

        return $this->redirect(['/admin/index-user']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
