<?php
class Ajax extends model
{
    public function getAjaxData() {
        $id = Input::get('id');
        $data = $this->dbRaw("SELECT * FROM event_picture WHERE event_id='{$id}'");
        if(count($data)) {
            echo json_encode(["status"=>"success", "result" => $data]);
        }else {
            echo json_encode(["status"=>"fails"]);
        }
    }
}