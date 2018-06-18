<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Change password form
 */
class ChangePassword extends Model
{
    public $old_pass;
    public $new_pass;
    public $repeat_pass;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['old_pass', 'new_pass', 'repeat_pass'], 'required'],
            [['old_pass', 'new_pass', 'repeat_pass'], 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'old_pass' => 'Старый пароль',
            'new_pass' => 'Новый пароль',
            'repeat_pass' => 'Подтверждение пароля'
        ];
    }


    /**
     * Sends email when changed password
     * @param $token
     */
    public function sendEmail($email)
    {
        Yii::$app->mailer->compose()
            ->setFrom('learnplat@mail.ru')
            ->setTo($email)
            ->setSubject('Смена пароля')
            ->setHtmlBody(
                '<b>Ваш пароль успешно изменен</b><br>
                        '
            )
            ->send();
    }

    public function changePassword($userId) {

        $user = User::findOne($userId);
        $hash = $user->password_hash;
        $email = $user->email;

        if (Yii::$app->getSecurity()->validatePassword($this->old_pass, $hash)) {

            if ($this->new_pass != $this->old_pass && $this->new_pass == $this->repeat_pass) {

                Yii::$app->session->setFlash('success', 'Пароль успешно изменен');
                $user->setPassword($this->new_pass);
                $user->save();

                $this->sendEmail($email);

                return true;
            } else if ($this->new_pass != $this->repeat_pass) {
                Yii::$app->session->setFlash('error', 'Новый пароль не потдвержден');
                return false;
            }
        } else {
            Yii::$app->session->setFlash('error', 'Старый пароль введен неверно');
            return false;
        }
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
