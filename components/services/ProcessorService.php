<?php

namespace app\components\services;

use app\components\enums\Status;
use app\components\form\ProcessorFilter;
use app\models\Request;
use Random\RandomException;
use Yii;
use yii\db\Exception;

class ProcessorService
{
    public function __construct(
        readonly private RequestService $requestService,
    )
    {
    }

    /**
     * @throws Exception
     * @throws RandomException
     */
    public function process(ProcessorFilter $filter): void
    {
        /** @var Request[] $requests */
        $requests = $this->requestService->findWaitRequest()->all();

        foreach ($requests as $request) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $this->setStatus($request, $filter->delay);
                $transaction->commit();
            } catch (Exception $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
    }

    /**
     * @throws RandomException
     * @throws Exception
     */
    private function setStatus(Request $request, int $delay): void
    {
        $approvedExists = $this->requestService->existApprovedRequestByUser($request->user_id);

        if ($approvedExists) {
            $request->status = Status::DECLINED->value;
        } else {
            $request->status = $this->getRandomStatus($delay);
        }

        if (!$request->save(false)) {
            throw new Exception('Failed to save request with id: ' . $request->id);
        }
    }

    /**
     * @throws RandomException
     */
    private function getRandomStatus($delay): int
    {
        sleep($delay);
        $approved = random_int(1, 10) === 1;

        return $approved
            ? Status::APPROVED->value
            : Status::DECLINED->value;
    }
}