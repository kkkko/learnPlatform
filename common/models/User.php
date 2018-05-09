<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $first_name
 * @property string $sur_name
 * @property string $male
 * @property string $avatar
 * @property string $about
 * @property string $phone_number
 * @property string $country
 * @property string $city
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['first_name', 'sur_name', 'email'], 'required'],
            [['first_name', 'sur_name'], 'string', 'max' => 20],
            ['email', 'email'],
            ['email', 'unique', 'targetAttribute' => ['email'], 'message' => 'Пользователь с такой почтой уже существует.'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'sur_name' => 'Фамилия',
            'email' => 'Email',
            'male' => 'Пол',
            'avatar' => 'Аватар',
            'about' => 'О себе',
            'phone_number' => 'Номер телефона',
            'country' => 'Страна',
            'city' => 'Город',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int)substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Generates random password
     */
    function genPassword($length = 10)
    {
        $chars = "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";
        $length = intval($length);
        $size = strlen($chars) - 1;
        $password = "";
        while ($length--) $password .= $chars[rand(0, $size)];
        return $password;
    }

    /**
     * Is Admin
     * @param $id
     * @return bool
     */
    public static function isAdmin($id)
    {
        $user = User::find()->one($id);
        if ($user->status == 10) {
            return true;
        }
        return true;
    }

    /**
     * Sends email to new user
     * @param $password
     */
    public function sendMail($password)
    {
        Yii::$app->mailer->compose()
            ->setFrom('learnplat@mail.ru')
            ->setTo($this->email)
            ->setSubject('Доступ к учебной платформе открыт')
            ->setHtmlBody(
                '<b>Для входа в систему используйте следующие данные:</b><br>
                        Логин: ваш Email<br>
                        Пароль: ' . $password . ''
            )
            ->send();
    }

    /**
     * Saving new user
     */
    public function saveUser()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new User();

        $password = $this->genPassword();
//        $user->sendMail($password);
        $user->setPassword($password);
        $user->generateAuthKey();
        $user->status = 10;
        return $this->save() ? $user : null;
    }
}
