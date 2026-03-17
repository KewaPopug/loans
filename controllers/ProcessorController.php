<?php

namespace app\controllers;

use app\components\form\ProcessorFilter;
use app\components\services\ProcessorService;
use Random\RandomException;
use Throwable;
use Yii;
use yii\db\Exception;
use yii\rest\Controller;

class ProcessorController extends Controller
{
    public function __construct(
        $id,
        $module,
        private readonly ProcessorService $processorService,
        $config = []
    ) {
        parent::__construct($id, $module, $config);
    }

    /**
     * @throws Exception
     * @throws Throwable
     * @throws RandomException
     */
    public function actionProcess(): array
    {
        $filter = new ProcessorFilter();
        $filter->load(Yii::$app->request->get(), '');
        $this->processorService->process($filter);

        return [
            'result' => true
        ];
    }
}