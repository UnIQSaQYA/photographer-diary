<?php 
class subCategory extends model {
	protected $tableName = 'sub_category';
	protected $primaryKey = 'id';
	protected $columnName = '*';
	protected $_validate;
	protected $_sessionName;

	private $rule = array(
		'sName' => array(
			'required' => true,
			'min' 	   => 3,
			'unique'   => 'sub_category|subcategory_name',
			'label'    => 'SubCategoryName',
		),
		'cid' => array(
			'required' => true,
		)
	);

	public function __construct()
	{
		parent::__construct();
		$this->_validate = new Validation();
	}

	public function createSubCategory()
	{
		$this->_validate->validate($this->rule);

		if($this->_validate->isValid()) {
			$data = [
			'subcategory_name'   => Input::post('sName'), 
			'category_id'        => Input::post('cid'), 			
			'status'          	 => 0, 
			];
			if($this->save($data)) {
				Session::set('success', 'SubCategory successfully added');
				Redirect::to(URL . 'admin/subcategory/view_subcategory.php');
			}
		}else {
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function getAllSubCategory(){
		$subCategory = $this->dbRaw('SELECT A.id, A.subcategory_name, A.created_at, B.category_name FROM sub_category A JOIN category B ON(A.category_id=B.id)');
		if(count($subCategory)) {
			return $subCategory;
		}else {
			return [];
		}
	}

	public function getSubCategory(){
		$id = Secure::decrypt(Input::get('id'));
		if(isset($id)){
			$subCategory = $this->get($id);
			if(count($subCategory)) {
				return $subCategory[0];
			}else{
				return [];
			}
		}
	}

	public function updateSubCategory()
	{
		$id = Secure::decrypt(Input::get('id'));
		$this->_validate->validate($this->rule);
		if($this->_validate->isValid()) {
			$data = [
			'subcategory_name'   => Input::post('sName'), 
			'category_id'        => Input::post('cid'), 			
			'status'          	 => 0, 
			];

			$update = $this->update($data, $id);
			if($update) {
				Session::set('success', 'SubCategory successfully added');
				Redirect::to(URL . 'admin/subcategory/view_subcategory.php');
			}
		}else {
			Session::set('validationErrors',$this->_validate->getErrors());
		}
	}

	public function deleteSubCategory($id) {
		$id = Secure::decrypt(Input::get('id'));
		if(isset($id)) {
			if($this->delete($id)) {
				Session::set('success', 'Sub category successfully deleted');
				Redirect::to(URL . 'admin/subcategory/view_subcategory.php');
			}else{
				Session::set('Warning', 'Sub category was not deleted');
				Redirect::to(URL . 'admin/subcategory/view_subcategory.php');
			}
		}
	}
}
