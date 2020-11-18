<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * User model
 * @property int $id_rol
 * @property int $id_user
 */

class Rol extends ActiveRecord
{

    public static function tableName()
    {
        return 'roles';
    }

    public static function getAdmin()//Busca todos las CIUDADES disponibles
    {
        return self::find()->where(['id_user'=>Yii::$app->user->identity->id])->andWhere(['id_rol'=>1])->one();
    }
    public static function getUser()//Busca todos las CIUDADES disponibles
    {
        return self::find()->where(['id_user'=>Yii::$app->user->identity->id])->andWhere(['id_rol'=>2])->one();
    }
}