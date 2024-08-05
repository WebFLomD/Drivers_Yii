<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CommentReviewsForm extends Model
{
    public $commentR;

    public function rules()
    {
        return [
            [['commentR'], 'required'],
            [['commentR'], 'string', 'length' => [3, 250]]
        ];
    }

    public function saveComment($id)
    {
        $comments = new Commentreviews();
        $comments -> text_reviews = $this->commentR;
        $comments -> id_user = Yii::$app->user->id;
        $comments -> id_reviews = $id;
        return $comments->save();

    }
}
