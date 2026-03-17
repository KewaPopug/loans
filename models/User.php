<?php

namespace app\models;

use yii\base\BaseObject;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

class User extends BaseObject implements IdentityInterface
{
    public int $id;
    public string $username;

    private static array $users = [
        '100' => [
            'id' => '100',
            'username' => 'admin',
            'password' => 'admin',
            'authKey' => 'test100key',
            'accessToken' => '100-token',
        ],
        '101' => [
            'id' => '101',
            'username' => 'demo',
            'password' => 'demo',
            'authKey' => 'test101key',
            'accessToken' => '101-token',
        ],
    ];

    public static function findIdentity($id): null|static
    {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    public function getId(): int|string
    {
        return $this->id;
    }

    /** @throws NotSupportedException */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }
}
