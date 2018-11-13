<?php

class Home extends model {

	protected $tableName = 'user_detail';
	protected $primaryKey = 'id';
	protected $columnName = '*';
	protected $_validate;
	protected $_sessionName;

	public $pagination="";

		public function __construct($user = NULL)
	{
		parent::__construct();
		$this->_validate = new Validation();
	}

	public function getPhotographer() {
		$slug = Input::get('u');
		if(isset($slug)) {
			$data = $this->dbRaw("
					SELECT A.first_name, A.last_name, A.profile_pic, A.cover_pic, B.email, C.contact_num, C.address, C.detail, D.subcategory_name, C.show_contact, C.facebook, C.google, C.twitter, C.linkedin, C.instagram
					FROM user_detail A
					LEFT JOIN users B ON(B.id = A.user_id)
					LEFT JOIN about C ON(C.user_id = A.id)
					JOIN sub_category D ON(A.subcategory_id = D.id)
					WHERE slug='{$slug}'
					");
			if(count($data)) {
				return $data[0];
			}else{
				return [];
			}
		}
	}

	public function getPhotographerEventById() {
		$slug = Input::get('u');
		$photographer = $this->dbRaw("SELECT * FROM user_detail WHERE slug = '{$slug}'");
		if(count($photographer)) {
			$event = $this->dbRaw("
				SELECT A.id, A.name, A.date, A.venue, A.organize_by, A.user_id, B.image FROM event A
				LEFT JOIN event_picture B ON (A.id = B.event_id AND B.is_cover = 1) WHERE user_id = '{$photographer[0]->id}'");
			if(count($event)) {
				return $event;
			}else {
				return [];
			}
		}
	}

	public function getAllPhotographer() {
		$this->limit = 8;
	    $config['limit'] = $this->limit;
	    $config['total_rows'] = $this->rowCount();
	    $offset = Pagination::initialize($config);
	    $this->offset = $offset;
	    if(!empty(Input::get('sort')))
	    {
	    	$type = Input::get('sort');
	    	$detail = $this->dbRaw("
				SELECT A.first_name, A.last_name, A.profile_pic, A.cover_pic, A.slug, B.email,  C.subcategory_name,D.detail, D.facebook, D.twitter, D.google, D.address, D.contact_num, D.show_contact
				FROM user_detail A 
				LEFT JOIN users B ON(B.id = A.user_id)
				JOIN sub_category C ON(C.id = A.subcategory_id)
				LEFT JOIN about D ON(D.user_id = A.id)
				WHERE first_name LIKE '{$type}%'
				ORDER BY A.created_at DESC
				". 'LIMIT' .' '. $this->limit. ' '. 'OFFSET'. ' '. $this->offset);
	    	
	    }else{
	    	$detail = $this->dbRaw('
				SELECT 
				A.first_name, A.last_name, A.profile_pic, A.cover_pic, A.slug, B.email, C.subcategory_name, D.detail, D.facebook, D.twitter, D.google, D.address, D.contact_num, D.show_contact
				FROM user_detail A  
				LEFT JOIN users B ON(B.id = A.user_id)
				LEFT JOIN sub_category C ON(C.id = A.subcategory_id) 
				LEFT JOIN about D ON(D.user_id = A.id) 
				ORDER BY A.created_at DESC '. 'LIMIT' .' '. $this->limit. ' '. 'OFFSET'. ' '. $this->offset);	
	    }
		if(count($detail)) {
		    $this->pagination = Pagination::createLinks();
		    return $detail;
			
		}else{
			return [];
		}
	}


	public function getGallery() {
		$slug = Input::get('u');
		$photographer = $this->dbRaw("SELECT * FROM user_detail WHERE slug = '{$slug}'");
		if(count($photographer)) {
			$event = $this->dbRaw("SELECT B.subcategory_name , A.user_id, A.id, A.photo, A.caption FROM gallery A LEFT JOIN sub_category B ON (A.type = B.id) WHERE A.user_id = '{$photographer[0]->id}' && A.type IS NOT NULL");
			if(count($event)) {
				return $event;
			}else {
				return [];
			}
		}
	}

	public function getPhotographerType() {
		$slug = Input::get('u');
		$photographer = $this->dbRaw("SELECT * FROM user_detail WHERE slug = '{$slug}'");
		if(count($photographer)) {
			$event = $this->dbRaw("SELECT B.subcategory_name FROM gallery A LEFT JOIN sub_category B ON (A.type = B.id) WHERE A.user_id = '{$photographer[0]->id}' && A.type IS NOT NULL");
			if(count($event)) {
				return $event;
			}else {
				return [];
			}
		}	
	}

	public function hitCounter() {
		$slug = Input::get('u');
		$photographer = $this->dbRaw("SELECT * FROM user_detail WHERE slug = '{$slug}'");
		$counter = $photographer[0]->counter;
		if(isset($counter)) {
			$i = $counter+1;
			$data = array(
				'counter' => $i,
			);
			$database = $this->update($data, $photographer[0]->id);
		} 
	}

	public function mostViewed() {
		$this->limit = 8;
	    $config['limit'] = $this->limit;
	    $config['total_rows'] = $this->rowCount();
	    $offset = Pagination::initialize($config);
	    $this->offset = $offset;
		$detail = $this->dbRaw('
				SELECT 
				A.first_name, A.last_name, A.profile_pic, A.cover_pic, A.slug, B.email, C.subcategory_name, D.detail, D.facebook, D.twitter, D.google, D.address, D.contact_num
				FROM user_detail A  
				JOIN users B ON(B.id = A.user_id)
				JOIN sub_category C ON(C.id = A.subcategory_id) 
				LEFT JOIN about D ON(D.user_id = B.id)
				ORDER BY counter desc '. 'LIMIT' .' '. $this->limit. ' '. 'OFFSET'. ' '. $this->offset);
	    $this->pagination = Pagination::createLinks();
	    return $detail;
	}

	public function featured() {
		$this->limit = 8;
	    $config['limit'] = $this->limit;
	    $config['total_rows'] = $this->rowCount();
	    $offset = Pagination::initialize($config);
	    $this->offset = $offset;
	     if(!empty(Input::get('sort')))
	    {
	    	$type = Input::get('sort');
	    	$detail = $this->dbRaw("
				SELECT A.first_name, A.last_name, A.profile_pic, A.cover_pic, A.slug, B.email,  C.subcategory_name,D.detail, D.facebook, D.twitter, D.google, D.address, D.contact_num, D.show_contact
				FROM user_detail A 
				LEFT JOIN users B ON(B.id = A.user_id)
				JOIN sub_category C ON(C.id = A.subcategory_id)
				LEFT JOIN about D ON(D.user_id = A.id)
				WHERE A.user_type = 1 && first_name LIKE '{$type}%'
				ORDER BY A.created_at DESC
				". 'LIMIT' .' '. $this->limit. ' '. 'OFFSET'. ' '. $this->offset);
	    	
	    }else{
		$detail = $this->dbRaw('
				SELECT 
				A.first_name, A.last_name, A.profile_pic, A.cover_pic, A.slug, B.email, C.subcategory_name, D.detail, D.facebook, D.twitter, D.google, D.address, D.contact_num, D.show_contact
				FROM user_detail A  
				LEFT JOIN users B ON(B.id = A.user_id)
				JOIN sub_category C ON(C.id = A.subcategory_id) 
				LEFT JOIN about D ON(D.user_id = B.id)
				WHERE A.user_type = 1
				ORDER BY A.created_at desc '. 'LIMIT' .' '. $this->limit. ' '. 'OFFSET'. ' '. $this->offset);
	    $this->pagination = Pagination::createLinks();
	    }
	    return $detail;
	}

	public function getTopTenPhotographer() {
		$this->limit = 8;
	    $config['limit'] = $this->limit;
	    $config['total_rows'] = $this->rowCount();
	    $offset = Pagination::initialize($config);
	    $this->offset = $offset;
		$detail = $this->dbRaw('
				SELECT 
				A.first_name, A.last_name, A.profile_pic, A.cover_pic, A.slug, B.email, C.subcategory_name, D.detail, D.facebook, D.twitter, D.google, D.address, D.contact_num
				FROM user_detail A  
				JOIN users B ON(B.id = A.user_id)
				JOIN sub_category C ON(C.id = A.subcategory_id) 
				LEFT JOIN about D ON(D.user_id = B.id)
				JOIN top_ten E ON(E.photographer_id = A.id)
				ORDER BY E.order_by desc '. 'LIMIT' .' '. $this->limit. ' '. 'OFFSET'. ' '. $this->offset);
	    $this->pagination = Pagination::createLinks();
	    return $detail;	
	}

	/**
	 * Get background image to display in the home page
	 * @return [type] [description]
	 */
	public function getBackgroundImage(){
		$image = $this->dbRaw("SELECT image From background WHERE type='background' ORDER BY RAND() LIMIT 1");
		if(count($image)) {
			return $image[0];
		}
	}

	/**
	 * Get cover image to display in the home page
	 * @return [type] [description]
	 */
	public function getCoverImage(){
		$image = $this->dbRaw("SELECT image From background WHERE type='cover' ORDER BY RAND() LIMIT 1");
		if(count($image)) {
			return $image[0];
		}
	}

	public function getLatestPhotographer(){
		$photographer = $this->dbRaw("SELECT * from user_detail ORDER BY created_at desc LIMIT 5");
		if(count($photographer)){
			return $photographer;	
		}else{
			return [];
		}
		
	}
}
