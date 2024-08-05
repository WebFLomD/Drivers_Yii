<?php

namespace app\controllers;

use app\models\Autoparts;
use app\models\Brandcar;
use app\models\Car;
use app\models\CommentForm;
use app\models\Commentnew;
use app\models\CommentReviewsForm;
use app\models\Newpost;
use app\models\Reviewscarpost;
use app\models\Typeofcar;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $brand_cars = BrandCar::find()->all();

        $query = Car::find();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 20]);
        $cars = $query->offset($pagination->offset)
            ->where(['id_status' => 2])
            ->limit($pagination->limit)
            ->orderBy(['date_of_registration_post_car' => SORT_DESC]) // Сортировка по убыванию поля "date"
            ->all();

        return $this->render('index',
        [
            'cars' => $cars,
            'brand_cars' => $brand_cars,
            'pagination' => $pagination,
        ]);
    }

    public function actionTechnic($id, $status = null)
    {
        $technics = Typeofcar::findOne($id);
        $query = Car::find()->where(['id_type_of_car' => $id]);

        if ($status !== null) {
            $query->andWhere(['id_status' => $status]);
        }

        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 20]);
        $cars = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['date_of_registration_post_car' => SORT_DESC]) // Сортировка по убыванию поля "date"
            ->all();

        return $this->render('technic',
        [
            'cars' => $cars,
            'pagination' => $pagination,
            'technics' => $technics,
        ]);
    }

    public function actionBrand_car($id)
    {
        $brand_cars = BrandCar::findOne($id);
        $query = Car::find()->where(['id_brand_car' => $id]);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 20]);
        $cars = $query->offset($pagination->offset)
            ->where(['id_status' => 2])
            ->andWhere('id_brand_car = :id_brand_car', [':id_brand_car' => $id])
            ->limit($pagination->limit)
            ->orderBy(['date_of_registration_post_car' => SORT_DESC]) // Сортировка по убыванию поля "date"
            ->all();

        return $this->render('brand_car', [
            'cars' => $cars,
            'brand_cars' => $brand_cars,
            'pagination' => $pagination,
        ]);
    }

    public function actionHelp()
    {
        return $this->render('help');
    }

    public function actionPurchase_and_sale_agreement()
    {
        return $this->render('purchase_and_sale_agreement');
    }

    public function actionAgreement()
    {
        return $this->render('agreement');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionDelete($id)
    {
        $post = Car::findOne($id);

        // Удаление фото из файла
        $photoPath1 = Yii::getAlias('@webroot/all_img/post_car/') . $post->photo_car_1;
        $photoPath2 = Yii::getAlias('@webroot/all_img/post_car/') . $post->photo_car_2;
        $photoPath3 = Yii::getAlias('@webroot/all_img/post_car/') . $post->photo_car_3;
        if (file_exists($photoPath1)) {
            unlink($photoPath1);
        }
        if (file_exists($photoPath2)) {
            unlink($photoPath2);
        }
        if (file_exists($photoPath3)) {
            unlink($photoPath3);
        }

        $post->delete();

        return $this->redirect(['/user/profile', 'id' => $post->id_user]); // Перенаправляем на страницу профиля после удаления
    }

    public function actionDeleteparts($id)
    {
        $post = Autoparts::findOne($id);

        if ($post === null) {
            throw new NotFoundHttpException("Запчасть не найдена.");
        }

        // Удаление фото из файла
        $photoPath = Yii::getAlias('@webroot/all_img/auto_parts/') . $post->photo_auto_parts;
        if (file_exists($photoPath)) {
            if (unlink($photoPath)) {
                Yii::info("Файл успешно удален: " . $photoPath, __METHOD__);
            } else {
                Yii::error("Не удалось удалить файл: " . $photoPath, __METHOD__);
            }
        } else {
            Yii::warning("Файл не найден: " . $photoPath, __METHOD__);
        }

        $post->delete();

        return $this->redirect(['/user/profile', 'id' => $post->id_user]); // Перенаправляем на страницу профиля после удаления
    }

    public function actionDeletenewpost($id)
    {
        $post = Newpost::findOne($id);

        if ($post === null) {
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        // Удаление фото из файла, если оно существует
        if (!empty($post->photo_new)) {
            $photoPath = Yii::getAlias('@webroot/all_img/new_post/') . $post->photo_new;
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $post->delete();

        return $this->redirect(['/newpost/mynewpost', 'id' => $post->id_user]); // Перенаправляем на страницу профиля после удаления
    }

    public function actionDeletereviewscarpost($id)
    {
        $post = Reviewscarpost::findOne($id);

        if ($post === null) {
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        // Удаление фото из файла, если оно существует
        if (!empty($post->photo_reviews)) {
            $photoPath = Yii::getAlias('@webroot/all_img/post_reviews/') . $post->photo_reviews;
            if (file_exists($photoPath)) {
                unlink($photoPath);
            }
        }

        $post->delete();

        return $this->redirect(['/reviewscarpost/myreviewscarpost', 'id' => $post->id_user]); // Перенаправляем на страницу профиля после удаления
    }

    public function actionComment($id)
    {
        $model = new CommentForm();

        if (Yii::$app->request->isPost){
            $model -> load(Yii::$app->request->post());
            if ($model->saveComment($id))
            {
                return $this->redirect(['/newpost/post', 'id' => $id]);
            }
        }
    }

    public function actionComments($id)
    {
        $model = new CommentReviewsForm();

        if (Yii::$app->request->isPost){
            $model -> load(Yii::$app->request->post());
            if ($model->saveComment($id))
            {
                return $this->redirect(['/reviewscarpost/post', 'id' => $id]);
            }
        }
    }

}
