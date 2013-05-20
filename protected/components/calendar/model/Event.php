<?php

/**
 * This is the model class for table "event".
 *
 * The followings are the available columns in table 'event':
 * @property string $id
 * @property string $user_id
 * @property string $create_date
 * @property string $event_date
 * @property string $title
 * @property string $link_user
 * @property string $event_type
 * @property string $event_text
 *
 * The followings are the available model relations:
 * @property Users $user
 * @property Users $linkUser
 */
class Event extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Event the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'event';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, create_date, event_date, title', 'required'),
			array('user_id, link_user', 'length', 'max'=>10),
			array('title', 'length', 'max'=>150),
			array('event_type', 'length', 'max'=>14),
			array('event_text', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, create_date, event_date, title, link_user, event_type, event_text', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'linkUser' => array(self::BELONGS_TO, 'Users', 'link_user'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'create_date' => 'Create Date',
			'event_date' => 'Event Date',
			'title' => 'Title',
			'link_user' => 'Link User',
			'event_type' => 'Event Type',
			'event_text' => 'Event Text',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('create_date',$this->create_date,true);
		$criteria->compare('event_date',$this->event_date,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('link_user',$this->link_user,true);
		$criteria->compare('event_type',$this->event_type,true);
		$criteria->compare('event_text',$this->event_text,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}