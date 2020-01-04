<?php

namespace app\models;

use yii\base\Model;
use yii\helpers\VarDumper;

class SignupForm extends Model{

    public $email;
    public $username;
    public $password;
    public $password_repeat;

    public function rules(){

        return[
            [['email', 'username', 'password', 'password_repeat'], 'required'],
            ['username', 'unique', 'targetClass' => 'app\models\User'],
            ['email', 'unique', 'targetClass' => 'app\models\User'],
            ['email', 'email', 'message' => 'Adj meg egy érvényes e-mail címet!'],
            ['password', 'string', 'min' => 6],
            ['password', 'match', 'pattern' => '/\d/', 'message' => 'A jelszónak tartalmaznia kell legalább egy számjegyet!'],
            [['email', 'username', 'password', 'password_repeat'],'string', 'max' => 55],
            ['password_repeat', 'compare', 'compareAttribute' => 'password']
        ];
    }

    public function attributeLabels(){
        return [
            'email' => 'E-mail cím',
            'username' => 'Felhasználónév',
            'password' => 'Jelszó',
            'password_repeat' => 'Jelszó újra'
        ];
    }

    public function signup(){

        $user = new User();
        
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = \Yii::$app->security->generatePasswordHash($this->password);
        $user->access_token = \Yii::$app->security->generateRandomString();
        $user->auth_key = \Yii::$app->security->generateRandomString();

        $user->save();

        $profile = new Profile();
        $profile->user_id = $user->id; 

        if($profile->save()){
            return true;
        }

        \Yii::error("Hiba történt a regisztráció során!". VarDumper::dumpAsString($user->errors));
        return false;
    }  
}