<?php

namespace frontend\controllers;

use common\models\User;
use frontend\models\ChangePassword;
use Yii;
use common\models\ImageUpload;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class AccountController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Displays account page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['id' => Yii::$app->user->id]),
        ]);
        return $this->render('index',
            [
                'dataProvider' => $dataProvider,
            ]);
    }

    /**
     * Updates an existing User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $avatar = new ImageUpload;

        if ($model->load(Yii::$app->request->post()) && $model->saveUserUpdate()) {
            $file = UploadedFile::getInstance($model, 'avatar');
            if ($file != null && $model->saveImage($avatar->uploadFile($file, $model->avatar))) {
                return $this->redirect(['/account/index']);
            }
            return $this->redirect(['/account/index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Chacnge password page.
     *
     * @return mixed
     */
    public function actionChangePassword()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $model = new ChangePassword();

        if ($model->load(Yii::$app->request->post())) {
            $model->changePassword(Yii::$app->user->id);
        }

        return $this->render('change_password',
            [
                'model' => $model,
            ]);
    }


    /**
     * Finds the Sections model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
