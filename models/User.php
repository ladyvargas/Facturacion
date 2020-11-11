<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $identificacion
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property string $sex
 * @property string $country
 * @property string $birth_place
 * @property string $birth
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $authKey
 * @property string $accessToken
 * @property integer $active
 * @property string $timestamp
 */
class User extends ActiveRecord implements IdentityInterface
{
    public $passNew;
    public $passNew2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'identificacion',
                    'first_name',
                    'last_name',
                    'address',
                    'sex',
                    'birth_place',
                    'country',
                    'birth',
                    ],'required', 'on' => 'create'
            ],
            [['username'], 'string','max'=>255],
            [['identificacion','username'], 'unique'],
            [['password'],'string', 'min' => 10],
            [['authKey','accessToken','password'], 'string','max'=>255],
            [
                [
                    'passNew',
                    'passNew2',
                    'username',
                ],'required', 'on' => 'changed'
            ],
            ['passNew2', 'compare','compareAttribute' => 'passNew', 'on' => 'changed'],
            [['passNew'],'string', 'min' => 10, 'on' => 'changed'],
            [['username'], 'unique', 'on' => 'changed'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'active' => 'Estado',
            'identificacion' => 'Identificación',
            'last_name' => 'Apellidos',
            'first_name' => 'Nombres',
            'address' => 'Dirección',
            'sex' => 'Sexo',
            'birth' => 'Nacimiento',
            'birth_place' => 'Lugar de nacimiento',
            'country' => 'País',
            'passOld' => 'Contraseña vieja',
            'passNew' => 'Contraseña nueva',
            'passNew2' => 'Repetir contraseña',
        ];
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface|null the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['accessToken'=>$token]);
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username,'active'=>'1']);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled. The returned key will be stored on the
     * client side as a cookie and will be used to authenticate user even if PHP session has been expired.
     *
     * Make sure to invalidate earlier issued authKeys when you implement force user logout, password change and
     * other scenarios, that require forceful access revocation for old sessions.
     *
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password){
        return password_verify($password,$this->password);
    }
    public static function findById($id)
    {
        return self::find()->where(['id' => $id])->one();
    }
    public static function findActives()
    {
        return self::find()->where(['active' => 1])->orderBy(['last_name'=>SORT_ASC])->asArray()->all();
    }
    public static function isUserUsers($id)
    {
        if (self::find()->leftJoin('rol','rol.id_users=users.id')->where(['id_users' => $id])->andWhere(['in','id_roles',[1,4,9,10]])->one()){
            return true;
        } else {
            return false;
        }
    }
    public static function isUserCourses($id)
    {
        if (self::find()->leftJoin('rol','rol.id_users=users.id')->where(['id_users' => $id])->andWhere(['in','id_roles',[1,9,10]])->one()){
            return true;
        } else {
            return false;
        }
    }
    public static function  getForSpecialDates($journey,$period)
    {
        $teacher = self::find()
            ->distinct()
            ->select('users.id as id, last_name, first_name')
            ->innerJoin('group_subjects as s1', 's1.user_id = users.id')
            ->innerJoin('group as g1', 'g1.id = s1.group_id')
            ->where(['g1.journeys' => $journey])
            ->andWhere(['g1.period_id'=>$period])
            ->asArray()
            ->all();
        $inspector = self::find()
            ->distinct()
            ->select('users.id as id, last_name, first_name')
            ->innerJoin('group as g1', 'g1.inspector_id=users.id')
            ->where(['g1.journeys' => $journey])
            ->andWhere(['g1.period_id'=>$period])
            ->asArray()
            ->all();
        $user = array_merge_recursive($teacher, $inspector);
        return array_map("unserialize", array_unique(array_map("serialize", $user)));
    }
}
