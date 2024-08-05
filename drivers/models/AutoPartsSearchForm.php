<?php

namespace app\models;

use yii\base\Model;
use yii\db\Query; // Добавьте эту строку

class AutoPartsSearchForm extends Model
{
    public $title_auto_parts;

    public function rules()
    {
        return [
            [['title_auto_parts'], 'string'],
        ];
    }

    public function search()
    {
        if (!$this->validate()) {
            return null;
        }

        $query = (new Query())
            ->select('*')
            ->from('autoparts')
            ->where(['like', 'title_auto_parts', $this->title_auto_parts])
            ->all();

        return $query;
    }
}