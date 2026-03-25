<?php

namespace app\controllers;

use app\components\services\RequestService;
use app\models\Request;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\rest\Controller;

class RequestController extends Controller
{
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'create' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @throws Exception
     */
    public function actionCreate(): array
    {
        $model = new Request();
        $model->load(Yii::$app->request->bodyParams, '');

        if ($model->validate()) {
            if ($model->save()) {
                Yii::$app->response->statusCode = 201;
                return [
                    'result' => true,
                    'id' => $model->id,
                ];
            }
        }

        Yii::$app->response->statusCode = 400;
        return [
            'result' => false,
        ];
    }
}