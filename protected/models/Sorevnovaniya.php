<?php

/**
 * This is the model class for table "{{sorevnovaniya}}".
 *
 * The followings are the available columns in table '{{sorevnovaniya}}':
 * @property integer $id
 * @property string $data
 * @property string $nazvanie
 * @property string $mesto
 * @property integer $status
 */
class Sorevnovaniya extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{sorevnovaniya}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status', 'numerical', 'integerOnly'=>true),
			array('data, nazvanie, mesto', 'safe'),
            array('data, nazvanie, status', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, data, nazvanie, mesto, status', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'zayavki' => array(self::HAS_MANY,'zayavki','id_sorevnovaniya'),
            'nomera' => array(self::HAS_MANY,'nomera','id_sorevn'),
            'finaly' => array(self::HAS_MANY,'finaly','id_sorevnovaniya'),
            'statusy' => array(self::BELONGS_TO,'statusy','status'),
            'koordinaty' => array(self::BELONGS_TO,'koordinaty','mesto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'data' => 'Дата',
			'nazvanie' => 'Название',
			'mesto' => 'Место',
			'status' => 'Статус'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search($stat=null)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('data',$this->data,true);
		$criteria->compare('nazvanie',$this->nazvanie,true);
		$criteria->compare('mesto',$this->mesto);
		$criteria->compare('status',$this->status);
        if(isset($stat)) {
            $criteria->condition = 'status=:status';
            $criteria->params = array(':status'=>$stat);
        }
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Sorevnovaniya the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
    
    public function beforeSave()
    {
        
        //var_dump($this->status);die;
        return parent::beforeSave();
    }
}
