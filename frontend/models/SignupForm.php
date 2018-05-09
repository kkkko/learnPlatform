<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $email;
    public $password;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Generates email cinfirm token and sets it to the model
     *
     */
    public function genEmailConfirmToken()
    {
        return Yii::$app->security->generateRandomString();
    }

    /**
     * Sends email to new user
     * @param $token
     */
    public function sendEmailToken($token)
    {
        Yii::$app->mailer->compose()
            ->setFrom('learnplat@mail.ru')
            ->setTo($this->email)
            ->setSubject('Подтверждение регистрации на учебном портале')
            ->setHtmlBody(
                '<b>Для подтверждения регистрации перейдите по ссылке:</b><br>
                        '
            )
            ->send();
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $emailToken = $this->genEmailConfirmToken();
        $user->email_confirm_token = $emailToken;
        $this->sendEmailToken($emailToken);
        
        return $user->save() ? $user : null;
    }
}
