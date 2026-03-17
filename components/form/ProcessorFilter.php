<?php

namespace app\components\form;

use yii\base\Model;

class ProcessorFilter extends Model
{
    public int $delay = 0;

    public function rules(): array
    {
        return [
            [['delay'], 'integer'],
        ];
    }
}