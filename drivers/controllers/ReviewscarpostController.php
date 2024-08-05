<?php

namespace app\controllers;

use app\models\Autoparts;
use app\models\CategoryReviews;
use app\models\Commentreviews;
use app\models\CommentReviewsForm;
use app\models\LikeReview;
use app\models\Reviewscarpost;
use app\models\search\ReviewscarpostSearch;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ReviewscarpostController implements the CRUD actions for Reviewscarpost model.
 */
class ReviewscarpostController extends Controller
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
                    'only' => ['create','myreviewscarpost', 'update', 'delete'],
                    'rules' => [
                        [
                            'actions' => ['myreviewscarpost', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                return Yii::$app->user->id == Yii::$app->request->get('id');
                            },
                        ],
                        [
                            'actions' => ['create'],
                            'allow' => true,
                            'roles' =>['@'],
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
     * Lists all Reviewscarpost models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $users = User::findOne(Yii::$app->user->id);

        $query = Reviewscarpost::find();
        $count = $query->count();
        $pagination = new Pagination([
            'totalCount' => $count,
            'pageSize' => 20,
        ]);
        $reviewscars = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['date_register_reviews' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'users' => $users,
            'reviewscars' => $reviewscars,
            'pagination' => $pagination,

        ]);
    }

    public function actionPost($id)
    {
        $users = User::findOne(Yii::$app->user->id);
        $reviews = Reviewscarpost::findOne($id);

        if ($reviews === null) {
            // Если пост не найден, перенаправляем на страницу ошибки 404
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        $query = Commentreviews::find()->where(['id_reviews' => $id])->all();
        $pagination = new Pagination(['totalCount' => count($query), 'pageSize' => 10]);
        $commentsP = Commentreviews::find()
            ->where(['id_reviews' => $id])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $comments = $reviews -> commentreviews;
        $CommentReviewsForm = new CommentReviewsForm();

        # Автосчетчик от всех пользователей (3 способ, при обновление страницы, счетчик набирается.
        # Счетчик набирается не смотря какой пользователь (Гость или авторизованый пользователь))
        if ($reviews) {
            $reviews -> viewed_reviews += 1;
            $reviews -> save();
        }


        return $this->render('post',
            [
                'reviews' => $reviews,
                'users' => $users,
                'commentsP' => $commentsP,
                'comments' => $comments,
                'CommentReviewsForm' => $CommentReviewsForm,
                'pagination' => $pagination,
            ]);
    }


    public function actionMyreviewscarpost($id)
    {
        $users = User::findOne($id);
        $posts = Reviewscarpost::find()->all();

        $query = Reviewscarpost::find()->where(['id_user' => $id]);
        $count = $query->count();
        $delposts = $query -> all();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $reviewscars = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['date_register_reviews' => SORT_DESC]) // Сортировка по убыванию поля "date"
            ->all();

        return $this->render('myreviewscarpost',[
//            'model' => $model,
            'users' => $users,
            'reviewscars' => $reviewscars,
            'posts' => $posts,
            'pagination' => $pagination,
            'delposts' => $delposts,
        ]);
    }

    public function actionLike($postId)
    {

        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;

            $like = new LikeReview();
            $like->id_reviewscarpost = $postId;
            $like->id_user = $userId;
            $like->save();

            return $this->redirect(Yii::$app->request->referrer);
        }
        // Если гость, его сразу перекидывает страницу "Авторизация" и не лайк не будет засчитан
        else {
            return $this->redirect(['site/login']);
        }
    }

    # Не нравится/дизлайк
    public function actionUnlike($postId)
    {
        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;

            LikeReview::deleteAll(['id_reviewscarpost' => $postId, 'id_user' => $userId]);

            return $this->redirect(Yii::$app->request->referrer);
        }
        // Если гость, его сразу перекидывает страницу "Авторизация" и не лайк не будет засчитан
        else {
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Displays a single Reviewscarpost model.
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
     * Creates a new Reviewscarpost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Reviewscarpost();

        $categoryReview = CategoryReviews::find()->all();

        if ($model->load($this->request->post()) && $model->validate()) {

            // Загрузка изображний (без ограничение, т.е. можно загружать/не загружать фото/изображение в БД)
            $model -> photo_reviews = UploadedFile::getInstance($model, 'photo_reviews');

            if ($model->photo_reviews) {
                $filename = md5(microtime()) . '.' . $model->photo_reviews->extension;

                if ($model->photo_reviews->saveAs('all_img/post_reviews/' . $filename)) {
                    $model->photo_reviews = $filename;
                }

            } else {
                $model->photo_reviews = ''; // Присваиваем пустое значение, если файл не был загружен
            }

            # Автоматически ставит, кто создал пост
            $model->id_user = Yii::$app->user->id;

            if ($model->save(false)) {

            }

            // Перекидывает на страницу "Новости"
            return $this->redirect(['/reviewscarpost']);
        }

        return $this->render('create', [
            'model' => $model,
            'categoryReview' => $categoryReview,
        ]);
    }

    /**
     * Updates an existing Reviewscarpost model.
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
     * Deletes an existing Reviewscarpost model.
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
     * Finds the Reviewscarpost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Reviewscarpost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Reviewscarpost::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
