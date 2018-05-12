<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "courses".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $mentor
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['title', 'description', 'mentor'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'description' => 'Описание',
            'mentor' => 'Закрепленный наставник',
        ];
    }

    public function getMentor()
    {
        return $this->hasOne(User::className(), ['id' => 'mentor_id']);
    }

    public function getMentorName() {
        $firstName = $this ->getMentor()->select('first_name');
        $surName = $this ->getMentor()->select('sur_name');

        return $name = $firstName .' ' .$surName;
    }

    /**
     * @return array
     */
    public function getSelectedMentor()
    {
        $selectedMentor = $this->getMentor()->select('id')->asArray()->all();
        return ArrayHelper::getColumn($selectedMentor, 'id');
    }

    /**
     * @param $id
     * @return bool
     */
    public function saveMentor($id)
    {
        $mentor = User::findOne($id);
        if ($mentor != null) {
            $this->link('mentor', $mentor);
            return true;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Sections::className(), ['id' => 'section_id'])
            ->viaTable('courses_sections', ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function saveSection($id)
    {
        if (isset($id)) {
                $section = Sections::findOne($id);
                $this->link('sections', $section);
            }
    }
}
