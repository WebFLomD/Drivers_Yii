<?php

namespace app\controllers;

use app\models\Category;
use app\models\CommentForm;
use app\models\Commentnew;
use app\models\Like;
use app\models\Newpost;
use app\models\search\NewpostSearch;
use app\models\User;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * NewpostController implements the CRUD actions for Newpost model.
 */
class NewpostController extends Controller
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
     * Lists all Newpost models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $users = User::findOne(Yii::$app->user->id); // Показывает пользователя, который авторизовался

        # Отображение поста + Пагинация
        $query = Newpost::find();
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 20]); // Пагинация с лимотом 20 постов
        $news = $query->offset($pagination->offset)
            ->limit($pagination->limit) // Смотрит на лимит $pagination
            ->orderBy(['date_register_new_post' => SORT_DESC]) // Сортировка по убыванию поля "date"
            ->all();

        return $this->render('index', [
            'news' => $news,
            'users' => $users,
            'pagination' => $pagination,
        ]);
    }

    public function actionPost($id)
    {
        $users = User::findOne(Yii::$app->user->id);
        $news = Newpost::findOne($id);

        if ($news === null) {
            // Если пост не найден, перенаправляем на страницу ошибки 404
            throw new NotFoundHttpException('The requested post does not exist.');
        }

        $query = Commentnew::find()->where(['id_new_post' => $id])->all();
        $pagination = new Pagination(['totalCount' => count($query), 'pageSize' => 10]);
        $commentsP = Commentnew::find()
            ->where(['id_new_post' => $id])
            ->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();

        $comments = $news->commentnews;
        $commentForm = new CommentForm();

        // Вывод текущего значения счетчика просмотров перед увеличением
//        echo "Current view count before increment: " . $news->viewed_new_post . "<br>";

        // Автосчетчик от всех пользователей (3 способ, при обновление страницы, счетчик набирается.
        // Счетчик набирается не смотря какой пользователь (Гость или авторизованый пользователь))
        if ($news) {
            $news->viewed_new_post += 1;
            if (!$news->save(false)) {
                // Если сохранение не удалось, выводим ошибки
                echo "Failed to save the model. Errors: " . json_encode($news->errors) . "<br>";
            }
        }

//        // Вывод текущего значения счетчика просмотров после увеличения
//        echo "Current view count after increment: " . $news->viewed_new_post . "<br>";
//
//        // Вывод отладочной информации
//        echo "User is guest: " . (Yii::$app->user->isGuest ? 'Yes' : 'No') . "<br>";
//        // Предполагается, что переменная $viewedPosts определена где-то в коде
//        // echo "Viewed posts: " . implode(', ', $viewedPosts) . "<br>";
//        echo "Current post ID: " . $news->id . "<br>";

        return $this->render('post', [
            'news' => $news,
            'users' => $users,
            'commentsP' => $commentsP,
            'comments' => $comments,
            'commentForm' => $commentForm,
            'pagination' => $pagination,
        ]);
    }


    public function actionMynewpost($id)
    {
        $users = User::findOne($id);
        $posts = Newpost::find()->all();

        $query = Newpost::find()->where(['id_user' => $id]);
        $count = $query->count();
        $delposts = $query -> all();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 5]);
        $news = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['date_register_new_post' => SORT_DESC]) // Сортировка по убыванию поля "date"
            ->all();

        return $this->render('mynewpost',[
//            'model' => $model,
            'users' => $users,
            'news' => $news,
            'posts' => $posts,
            'pagination' => $pagination,
            'delposts' => $delposts,
        ]);
    }

    # Нравится/лайк
    public function actionLike($postId)
    {

        if (!Yii::$app->user->isGuest) {
            $userId = Yii::$app->user->id;

            $like = new Like();
            $like->id_new_post = $postId;
            $like->id_user = $userId;
            $like->save();

            # переброс на ту же страницу и В НУЖНОЕ место пользователя
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

            Like::deleteAll(['id_new_post' => $postId, 'id_user' => $userId]);

            # переброс на ту же страницу и В НУЖНОЕ место пользователя
            return $this->redirect(Yii::$app->request->referrer);
        }
        // Если гость, его сразу перекидывает страницу "Авторизация" и не лайк не будет засчитан
        else {
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Displays a single Newpost model.
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
     * Creates a new Newpost model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */

    // Создание пост-новости
    public function actionCreate()
    {
        $model = new Newpost();
        $categoryPosts = Category::find()->all();

        if ($model->load($this->request->post()) && $model->validate()) {

            // Загрузка изображний (без ограничение, т.е. можно загружать/не загружать фото/изображение в БД)
            $model -> photo_new = UploadedFile::getInstance($model, 'photo_new');

            if ($model->photo_new) {
                $filename = md5(microtime()) . '.' . $model->photo_new->extension;

                if ($model->photo_new->saveAs('all_img/new_post/' . $filename)) {
                    $model->photo_new = $filename;
                }

            } else {
                $model->photo_new = ''; // Присваиваем пустое значение, если файл не был загружен
            }

            # Автоматически ставит, кто создал пост
            $model->id_user = Yii::$app->user->id;

            if ($model->save(false)) {

            }

            // Перекидывает на страницу "Новости"
            return $this->redirect(['/newpost']);
        }

        return $this->render('create', [
            'model' => $model,
            'categoryPosts' => $categoryPosts,
        ]);
    }

    /**
     * Updates an existing Newpost model.
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
     * Deletes an existing Newpost model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $new = Newpost::findOne($id);
        if ($new) {
            $userId = $new->id_user; // Сохраняем id пользователя
            $new->delete();

            return $this->redirect(['/newpost/mynewpost', 'id' => $userId]); // Перенаправляем на страницу профиля после удаления
        }

//        $this->findModel($id)->delete();
//
//        return $this->redirect(['index']);
    }



    /**
     * Finds the Newpost model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Newpost the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Newpost::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
