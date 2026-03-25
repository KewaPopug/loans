<?php

namespace app\controllers;

use app\components\form\ProcessorFilter;
use app\components\services\ProcessorService;
use Random\RandomException;
use Throwable;
use TypeError;
use Yii;
use yii\db\Exception;
use yii\filters\VerbFilter;
use yii\rest\Controller;

class ProcessorController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly ProcessorService $processorService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
    }


    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'process' => ['get'],
                ],
            ],
        ];
    }

    /**
     * @throws Exception
     * @throws Throwable
     * @throws RandomException
     */
    public function actionProcess(): array
    {
        $filter = new ProcessorFilter();
        try {
            $filter->load(Yii::$app->request->get(), '');
        } catch (TypeError $e) {
            Yii::$app->response->statusCode = 400;
            return [
                'result' => false,
            ];
        }

        $this->processorService->process($filter);

        return [
            'result' => true
        ];
    }
}