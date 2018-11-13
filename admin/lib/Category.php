<?php 
class Category extends model {
	protected $tableName = 'category';
	protected $primaryKey = 'id';
	protected $columnName = '*';
	protected $_validate;
	protected $_sessionName;

	private $rule = array(
		'cName' => array(
			'required' => true,
			'min' 	   => 3,
			'unique'   => 'category|category_name',
			'label'    => 'Category Name',
		),
	);

	public function __construct()
	{
		parent::__construct();
		$this->_validate = new Validation();
	}

	public function createCategory()
	{

		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
			'category_name'   => Input::post('cName'), 
			'status'          => 0, 
			'created_by'	  => Session::get('id'),
			];
			if($this->create($data)) {
				Session::set('success', 'Category suncessfully added');
				Redirect::to(URL . 'admin/category/view_category.php');
			}
		}else {
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function getAllCategory() {
		
		$category = $this->dbRaw('SELECT A.id, A.category_name, A.created_at, B.username FROM category A LEFT JOIN admin B ON (A.created_by = B.id)');
		if(count($category)) {
			return $category;
		}else {
			return [];
		}
	}

	public function getCategory() {
		$id = Input::get('id');
		if(isset($id)) {
			$category = $this->get($id);
			if(count($category)) {
				return $category[0];
			}else {
				return [];
			}
		}
	}

	public function updateCategory() {
		$this->_validate->validate($this->rule);
		$id = Input::get('id');
		if($this->_validate->isValid()) {
			$data = [
			'category_name'   => Input::post('cName'), 
			'status'          => 0, 
			];
			if($this->update($data, $id)) {
				Session::set('success', 'Successfully edited');
				Redirect::to(URL . 'admin/category/view_category.php');
			}
		}else {
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function deleteCategory($id){
		$id = Secure::decrypt($id);
		if($this->delete($id)){
			Session::set('success', 'Successfully deleted');
			Redirect::to(URL . 'admin/category/view_category.php');
		}else{
			Session::set('warning', 'Data could not be deleted');
			Redirect::to(URL . 'admin/category/view_category.php');	
		}
	}
}