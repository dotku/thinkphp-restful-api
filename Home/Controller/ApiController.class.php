<?php
/**
 * 总是在 REQUST 操作之后进行 GET 的操作。
 */
namespace Home\Controller;
use Think\Controller;
class ApiController extends Controller {
    public $output = array();
    public function index($table="news"){
        if ($_GET['table']) {
            $_GET['table']? $table = $_GET['table'] : '';
            // $this->model 

            switch (strtolower($_SERVER['REQUEST_METHOD'])) {
                case 'post':
                    $this->_post();
                    break;
                case 'put':
                    $this->_put();
                    break;
                case 'delete':
                    $this->_delete();
                    break;
                
                default:
                    # code...
                    break;
            }
            $this->_get();
        } else {
            $this->show('this is api page');
        }
        
    }
    public function _get(){
        $model = D($_GET['table']);
        intval($_GET['limit']) ? $limit = $_GET['limit'] : $limit = 30;
        $list = $model->order('createTime desc')->limit($limit)->select();

        // 通过 URL 中的 id 来查找
        if ($_GET['id']) {
            $map[$_GET['table']."_id"] = $_GET['id'];
            $this->output['info'] = $model->where($map)->find();
        }
        
        // 通过 body data 中的数据来查找
        $input = json_decode(file_get_contents("php://input"), true);
        $info = $model->where($input)->select();
        if ($info) {
            $this->output['info'] = $info;
        }

        if (!empty($list)){

            $this->output['list'] = $list;
        } else {
            $this->output['msg'] = 'either reading error or empty';
            $this->output['code'] = -1;
        }
        
        echo json_encode($this->output, JSON_UNESCAPED_UNICODE);
    }
    public function _post(){
        /*
        if($_SESSION['user']['role'] !='admin'){
            $this->output['msg_post'] = 'permission denied';
            $this->output['code'] = -1;
            return -1;
        } 
        */
        $model = D($_GET['table']);
        $input = json_decode(file_get_contents("php://input"), true);
        if ($model->create($input)){
            $model->add();
        } else {
            $this->output['msg_post'] = 'add entry failed';
            $this->output['code'] = -1;
        }
        $this->output['input'] = $input;
    }
    public function _put(){
        $model = D($_GET['table']);
        $input = json_decode(file_get_contents("php://input"), true);
        $map[$_GET['table']."_id"] = $input[$_GET['table']."_id"];
        $info = $model->where($map)->select();

        if ($info) {
            $data = array_merge($info, $input);
            $model->data($data)->save();
            $this->output['msg'] = 'entry updated successfully';
            $this->output['code'] = 1;
        } else {
            $this->output['msg'] = 'entry updated failed';
            $this->output['code'] = -1;
        }
        echo "this is put";
    }
    public function _delete(){
        $model = D($_GET['table']);
        $map = $input = json_decode(file_get_contents("php://input"), true);
        // $map[$_GET['table']."_id"] = $input[$_GET['table']."_id"];
        /*
        if ($_GET['id']) {
            $map[$_GET['table']."_id"] = $_GET['id'];
            $this->output['info'] = $model->where($map)->find();
        }
        */

        $info = $model->where($map)->select();
        if ($info) {
            $model->where($map)->delete();
            $this->output['msg'] = 'entry remove successfully';
            $this->output['code'] = 1;
        } else {
            $this->output['msg'] = 'no entry found';
            $this->output['code'] = -1;
        }
    }
}