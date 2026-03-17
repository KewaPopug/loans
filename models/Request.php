<?php

namespace app\models;

use app\components\enums\Status;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "requests".
 *
 * @property int $id идентификатор заявки.
 * @property int $user_id идентификатор пользователя, подающего заявку.
 * @property float $amount сумма займа, которую пользователь запрашивает.
 * @property int $term срок займа в днях
 * @property int $status статус заявки (например, "wait", "approved", "declined").
 */
class Request extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'requests';
    }

    public function rules(): array
    {
        return [

            [['user_id', 'amount', 'term'], 'required'],
            [['user_id', 'term', 'status'], 'default', 'value' => null],
            [['user_id', 'term', 'status'], 'integer'],
            [['amount'], 'number'],
            [['status'], 'default', 'value' => 0],
            ['user_id', 'validateApprovedRequest']
//            [['status'], 'range' => Status::values(), 'value' => 0],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь ID',
            'amount' => 'Сумма',
            'term' => 'Срок',
            'status' => 'Статус',
        ];
    }

    public function validateApprovedRequest(string $attribute): void
    {
        $exists = self::find()->where([
            'user_id' => $this->user_id,
            'status'  => Status::APPROVED->value,
        ])->exists();

        if ($exists) {
            $this->addError($attribute, 'User already has an approved loan request.');
        }
    }
}
