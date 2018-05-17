<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
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
 * @property string $birth_date
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
            ['status', 'default', 'value' => self::STATUS_DELETED],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['first_name', 'sur_name', 'email'], 'required'],
            [['first_name', 'sur_name', 'male'], 'string', 'max' => 20],
            [['avatar', 'phone_number', 'country', 'city', 'birth_date'], 'string'],
            [['about'], 'string', 'max' => 200],
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
            'birth_date' => 'Дата рождения'
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
     * Is Admin
     * @param $id
     * @return bool
     */
//    public static function isAdmin($id)
//    {
//        $user = User::find()->one($id);
//        if ($user->status == 10) {
//            return true;
//        }
//        return true;
//    }

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
     * Generates email cinfirm token and sets it to the model
     *
     */
    public function genEmailConfirmToken()
    {
        return Yii::$app->security->generateRandomString();
    }

    /**
     * Sends email to new user
     * @param $email
     * @param $token
     * @param $password
     */
    public function sendEmail($email, $token, $password)
    {
        Yii::$app->mailer->compose()
            ->setFrom('learnplat@mail.ru')
            ->setTo($email)
            ->setSubject('Подтверждение регистрации на учебном портале')
            ->setHtmlBody(
                '  <p>Здравсвуйте!<br>Вы зарегистрированы в системе дистанционного образования "Название"</p>
                        <p>Пожалуйста, подтвердите свой эл. адрес перейдя по ссылке:</p>
                        <a href="' . Yii::$app->request->getHostName() . '/site/activate?email=' . $this->email . '&token=' . $token . '">Подтвержение e-mail</a><br>
                        <p>Ваш логин:' . $email . '<br>
                        Ваш пароль: ' . $password . '<br>
                        Вы можете войти в личный кабинет по адресу [пока что отсутствует] введя свой логин и пароль<br>
                        Если у вас возникнут какие-либо вопросы или технические сложности,<br>
                        вы можете задать их, воспользовавшись контактами, указанными ниже:<br>
                        Тел: +7 909 909 90 90<br>
                        E-mail: email@mail.ru
                        <p>'
            )
            ->send();
    }

    /**
     * Saves new user
     */
    public function saveUser()
    {
        if (!$this->validate()) {
            return null;
        }

        $email = $this->email;

        $password = $this->genPassword();
        $token = $this->genEmailConfirmToken();
        $this->email_confirm_token = $token;

        $this->sendEmail($email, $token, $password);

        $this->setPassword($password);
        $this->generateAuthKey();

        return $this->save() ? $this : null;
    }

    /**
     * Saves updated user
     */
    public function saveUserUpdate()
    {
        if (!$this->validate()) {
            return null;
        }

        return $this->save() ? $this : null;
    }

    /**
     * Activates user
     * @param $email
     * @param $token
     * @return bool|int
     */
    public function activateUser($email, $token)
    {

        $user = User::find()->where(['email' => $email])->one();

        if ($user) {
            if ($user->email_confirm_token == $token) {
                $user->status = self::STATUS_ACTIVE;
                $newToken = $this->genEmailConfirmToken();
                $user->email_confirm_token = $newToken;
                return $user->save() ? $user : null;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    /**
     * isAdmin
     * @param $id
     * @return bool
     */
    public static function isAdmin($id)
    {
        $user = new User;
        $user = $user->find()->where(['id' => $id])->one();

        if ($user) {
            if ($user->isAdmin == 1) {
                return false;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Gets all mentors
     * @param $id
     * @return bool
     */
    public static function getAllMentors()
    {
        $mentors = User::find()->where(['isMentor' => 1])->all();
        $mentors = ArrayHelper::map($mentors, 'id', 'sur_name');
        return $mentors;
    }

    public function getCourse()
    {
        return $this->hasOne(Courses::className(), ['mentor_id' => 'id']);
    }

    /**
     * @param $filename
     * @return bool
     */
    public function saveImage($filename)
    {

        $this->avatar = $filename;
        return $this->save(false);

    }

    /**
     * @return string
     */
    public function getImage()
    {
        return ($this->avatar) ? '/uploads/' . $this->avatar : 'no-image.png';
    }

    public function deleteImage()
    {

        $ImageUploadModel = new ImageUpload();
        $ImageUploadModel->deleteCurrentImage($this->avatar);

    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {

        $this->deleteImage();
        return parent::beforeDelete(); // TODO: Change the autogenerated stub

    }
}
