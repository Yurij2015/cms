<?php
/**
 * Расширенная модель страницы сайта.
 *
 * У каждой страницы добавляется, возможности:
 *  - добавлять главный image
 *  - добавлять второстепенный image_cover
 *  - добавлять много images
 *  - добавлять много files
 *  - можно голлосовать
 *  - можно комментировать
 *  - можно подписываться
 *  - добавляется полное и краткое описание страницы
 *
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010-2014 SkeekS (Sx)
 * @date 31.10.2014
 * @since 1.0.0
 */
namespace skeeks\cms\models;

use skeeks\cms\models\behaviors\HasAdultStatus;
use skeeks\cms\models\behaviors\HasComments;
use skeeks\cms\models\behaviors\HasDescriptionsBehavior;
use skeeks\cms\models\behaviors\HasFiles;
use skeeks\cms\models\behaviors\HasStatus;
use skeeks\cms\models\behaviors\HasSubscribes;
use skeeks\cms\models\behaviors\HasVotes;

use skeeks\cms\models\behaviors\traits\HasDescriptionsTrait;
use skeeks\cms\models\behaviors\traits\HasFiles as THasFiles;
use skeeks\cms\models\behaviors\traits\HasSubscribes as THasSubscribes;
use skeeks\cms\models\behaviors\traits\HasVotes as THasVotes;
use skeeks\cms\models\behaviors\traits\HasComments as THasComments;

use Yii;

/**
 * @property string $image
 * @property string $image_cover
 * @property string $images
 * @property string $files
 *
 * Class PageAdvanced
 * @package skeeks\cms\base\models
 */
abstract class PageAdvanced extends Page
{
    //use THasComments;
    //use THasSubscribes;
    //use THasVotes;
    use THasFiles;
    //use HasDescriptionsTrait;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [

            //HasComments::className(),
            //HasSubscribes::className(),
            //HasVotes::className(),
            //HasDescriptionsBehavior::className(),
            //HasAdultStatus::className() => HasAdultStatus::className(),
            HasStatus::className() => HasStatus::className(),
            behaviors\HasFiles::className() =>
            [
                'class' => behaviors\HasFiles::className()
            ]
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'files' => Yii::t('app', 'Files'),
            'description_short' => Yii::t('app', 'Description Short'),
            'description_full' => Yii::t('app', 'Description Full'),
            'status' => Yii::t('app', 'Status'),
            'status_adult' => Yii::t('app', 'Status Adult'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['description_short', 'description_full'], 'string'],
            [['status', 'status_adult'], 'integer'],
        ]);
    }
}