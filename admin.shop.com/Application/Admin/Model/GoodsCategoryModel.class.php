<?php
namespace Admin\Model;


use Admin\Service\NestedSetsService;
use Think\Model;


class GoodsCategoryModel extends BaseModel
{
    // 每个表单都有自己的验证规则
    protected $_validate = array(
        array('name','require','分类名称不能够为空'),
        array('parent_id','require','父分类不能够为空'),
        array('status','require','是否显示不能够为空'),
    );
    public function getTreeList($isJSON=false,$field='*'){
        $rows=$this->field($field)->where(array('status'=>array('egt',0)))->order('lft')->select();
        if($isJSON){
            return json_encode($rows);
        }
        return $rows;
    }

    public function add(){
        //创建执行sql的对象
        $dbMysql = new DbMysqlInterfaceImplModel();

        //计算边界
        $nestedSetsService = new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');

        //添加的节点信息放到哪个父节点下. 并且返回该节点对应的id
        return $nestedSetsService->insert($this->data['parent_id'],$this->data,'bottom');
    }


    public function save(){

        //.创建执行sql的对象
        $dbMysql = new DbMysqlInterfaceImplModel();

        //计算边界
        $nestedSetsService = new NestedSetsService($dbMysql,'goods_category','lft','rgt','parent_id','id','level');

        //将指定的节点移动一个父分类下面
        $nestedSetsService->moveUnder($this->data['id'],$this->data['parent_id']);

        //需要将请求中的其他数据修改到数据库中
        return parent::save();

    }
    public function changeStatus($id, $status = -1)
    {

        //根据自己的id找到自己以及子孙节点的id
        $sql = "select child.id from  goods_category as child,goods_category as parent where  parent.id = {$id}  and child.lft>=parent.lft  and child.rgt<=parent.rgt";
        $rows = $this->query($sql);
        $id  = array_column($rows,'id');
        $data = array('id' => array('in', $id), 'status' => $status);
        if ($status == -1) {
            $data['name'] = array('exp', "concat(name,'_del')");
        }
        return parent::save($data);
    }
}
