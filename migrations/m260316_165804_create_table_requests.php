<?php

use app\components\enums\Status;
use yii\db\Migration;

class m260316_165804_create_table_requests extends Migration
{
    private string $tableName = 'requests';
    public function safeUp(): void
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('идентификатор заявки.'),
            'user_id' => $this->integer()->notNull()->comment('идентификатор пользователя, подающего заявку.'),
            'amount' => $this->decimal(10, 2)->notNull()->comment('сумма займа, которую пользователь запрашивает.'),
            'term' => $this->integer()->notNull()->comment('срок займа в днях'),
            'status' => $this->integer()->notNull()->defaultValue(Status::WAIT->value)->comment('статус заявки (например, "wait", "approved", "declined").'),
        ]);
    }

    public function safeDown(): void
    {
        $this->dropTable($this->tableName);
    }
}
