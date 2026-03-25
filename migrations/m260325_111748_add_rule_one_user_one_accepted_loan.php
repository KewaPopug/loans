<?php

use app\components\enums\Status;
use yii\db\Migration;

class m260325_111748_add_rule_one_user_one_accepted_loan extends Migration
{
    private string $tableName = 'requests';

    public function safeUp(): void
    {
        $status = Status::APPROVED->value;
        $this->execute("
            CREATE UNIQUE INDEX unique_approved_application_per_user
            ON $this->tableName (user_id)
            WHERE status = $status
        ");
    }


    public function safeDown(): void
    {
        $this->dropIndex('unique_approved_application_per_user', $this->tableName);
    }
}
