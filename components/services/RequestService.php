<?php

namespace app\components\services;

use app\components\enums\Status;
use app\models\Request;
use yii\db\ActiveQuery;

class RequestService
{
    public function findWaitRequest(): ActiveQuery
    {
        return Request::find()
            ->where([
                'status' => Status::WAIT->value
            ]);
    }

    public function findApprovedRequestByUser(int $user_id): ActiveQuery
    {
        return Request::find()->where([
            'user_id' => $user_id,
            'status' => Status::APPROVED->value,
        ]);
    }

    public function findApprovedRequestByUserWithBlockQuery(int $user_id): ActiveQuery
    {
        $query = $this->findApprovedRequestByUser($user_id)->createCommand()->getRawSql();
        return Request::findBySql($query . ' FOR UPDATE');
    }

    public function existApprovedRequestByUser(int $user_id): bool
    {
        return $this->findApprovedRequestByUserWithBlockQuery($user_id)->exists();
    }
}