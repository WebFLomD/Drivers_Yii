<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CommentForm extends Model
{
    public $comment;

    public function rules()
    {
        return [
            [['comment'], 'required'],
            [['comment'], 'string', 'length' => [3, 250]]
        ];
    }

    public function saveComment($id)
    {
        $comments = new Commentnew();
        $comments -> text_new = $this->comment;
        $comments -> id_user = Yii::$app->user->id;
        $comments -> id_new_post = $id;
        return $comments->save();

    }
}
