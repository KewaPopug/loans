<?php

namespace app\controllers;

use app\components\services\RequestService;
use app\models\Request;
use Yii;
use yii\db\Exception;
use yii\rest\Controller;

class RequestController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly RequestService $requestService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
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
                // todo строгий вывод по средством класса
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