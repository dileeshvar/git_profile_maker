<?php

/**
 * this class contains all the github user data.
 */

class User{	
	// the array will be used to set the fields dynamically in th class and can be used to set the fields in th database
	protected static $db_fields=array('user_id','login','name','email','blog','company','location','public_repo_count','public_gist_count','followers_count','following_count');
	private $user_id='';
	private $login='';
	public $name='';
	private $email='';
	private $blog='';
	private $company='';
	private $location='';
	private $public_repo_count='';
	private $public_gist_count='';
	private $followers_count='';
	private $following_count='';
	
	public function __get($property) {
    if (property_exists($this, $property)) {
      return $this->$property;
    }
  }

  //currently not used any where as the app advances we can use this to set the user object from outside this class
  public function __set($property, $value) {
    if (property_exists($this, $property)) {
      $this->$property = $value;
    }
    return $this;
  }
  
  /**
   * return get_object_vars($this); 
   */
  protected function attribute(){
		$attribtes = array();
		foreach(self::$db_fields as $field){
			if(property_exists($this,$field)){
				$attribtes[$field]=$this->$field;
			}
		}
		return $attribtes;
	}
  /**
   * boolean function returns true if $attribute is present in object_vars array
   */
  public function has_attribute($attribute){
		$object_vars=$this->attribute();
		return array_key_exists($attribute,$object_vars);		
	}
	
	/**
	 * this method is used to set values in to the user object.
	 */
	public static function instantiate($record){
		$object = new self;	        
	        foreach($record as $attribute=>$value){
	                if($object->has_attribute($attribute))
	                        $object->$attribute=$value;
	        }
	        return $object;
	}
}
?>
