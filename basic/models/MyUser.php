<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $authkey
 *
 * @property UserPi[] $userPis
 */
class MyUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{/*
    public $id;
    public $username;
    public $password;
    public $authKey;*/
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password', 'authKey'], 'string', 'max' => 255],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Authkey',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPis()
    {
        return $this->hasMany(UserPi::className(), ['user_id' => 'id']);
    }

    public function getAuthKey() {
        return $this->authKey;
    }

    public function getId() {
        return $this->id;
    }

    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    public static function findIdentity($id) {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        throw new \yii\base\NotSupportedException;
    }

    public static function findByUsername($username) {
   //     $this->password = self::findOne(['username'=>$username])->password;
        return self::findOne(['username'=>$username]);
    }
    
    public function validatePassword($password){
        return $this->password === $password;
    }
}
