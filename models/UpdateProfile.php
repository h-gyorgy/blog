<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\VarDumper;


class UpdateProfile extends Model
{
    public $email;
    public $oldEmail;
    public $username;
    public $oldUsername;
    public $password;
    public $password_repeat;
    public $date_of_birth;
    public $about_me;
    public $city;
   
    public function rules()
    {
        return [
            ['username', 'unique', 'targetClass' => 'app\models\User'],
            ['email', 'unique', 'targetClass' => 'app\models\User'],
            ['email', 'email'],
            ['password', 'string', 'min' => 6],
            ['password', 'match', 'pattern' => '/\d/', 'message' => 'A jelszónak tartalmaznia kell legalább egy számjegyet!'],
            [['email', 'username', 'password', 'password_repeat'],'string', 'max' => 55],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'A beírt jelszavaknak meg kell egyezniük!'],
            ['password', 'compare', 'compareAttribute' => 'password_repeat', 'message' => 'A beírt jelszavaknak meg kell egyezniük!'],
            [['date_of_birth'], 'date', 'format' => 'php:Y-m-d', 'message' => 'Érvénytelen dátum! Pl.: 1985-08-07'],
            [['about_me'], 'string', 'max' => 1000],
            [['city'], 'string', 'max' => 100],
            ['city', 'exist', 'targetClass' => City::class, 'targetAttribute' => ['city' => 'name'], 'message' => 'Adj meg egy érvényes településnevet!'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'E-mail cím',
            'username' => 'Felhasználónév',
            'password' => 'Jelszó',
            'password_repeat' => 'Jelszó újra',
            'date_of_birth' => 'Születési idő (ÉÉÉÉ-HH-NN)',
            'about_me' => 'Bemutatkozás',
            'city' => 'Település',
        ];
    }

    public function updateProfile($id){

        $user = User::findIdentity($id);

        $this->username == null ? : $user->username = $this->username;
        $this->email == null ? : $user->email = $this->email;
        $this->password == null ? : $user->password = \Yii::$app->security->generatePasswordHash($this->password);
       
        $user->profile->date_of_birth = $this->date_of_birth;
        $user->profile->about_me = $this->about_me;
        $user->profile->city = $this->city;

        if($user->save() && $user->profile->save() ){
            return true;
        }

        \Yii::error("Profil frissítése nem sikerült". VarDumper::dumpAsString($user->errors));
        return false;
    }
}
