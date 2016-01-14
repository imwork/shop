<?php
/**
 * Created by PhpStorm.
 * User: yu
 * Date: 2016/1/10
 * Time: 21:55
 */

namespace Admin\Model;


use Think\Model;
use Think\Page;

class BaseModel extends Model
{
    //批量验证开启
    protected $patchValidate = true;

//    public function remove($id){
//        //移除商品是把'status'修改-1
//        return parent::save(array('status'=>-1,'id'=>$id));
//    }

    public function getList(){
        //只查询商品status大于-1的
        return $this->where(array('status'=>array('gt',-1)))->select();
    }

    /**
     * 分页工具条
     * @return array
     */
    public function getPageResult($wheres=array()){
        //总条数和分页列表都要查询出状态>-1的数据
        $wheres['status'] = array('gt',-1);
        //分页工具条html
        //每页多少条
        $pageSize = 2;
        //总条数
        $totalRows = $this->where($wheres)->count();
        //实例化对象
        $page = new Page($totalRows,$pageSize);
        //生成分页的html
        $pageHtml = $page->show();
        //起始条数大于中条数 就显示最后一页
        if($page->firstRow>$totalRows){
            //起始条数=总条数-每页条数
            $page->firstRow = $totalRows-$page->listRows;
        }
        //分页列表数据
        $row = $this->where($wheres)->limit($page->firstRow,$page->listRows)->select();
        //返回$row和$pageHtml
        return array('rows'=>$row,'pageHtml'=>$pageHtml);
    }

    /**
     * @param $id
     * @param int $status
     * @return bool
     * 商品移除 和 显示状态更改
     */
    public function changeStatus($id,$status=-1){
        //获取id和status的值
        $data = array('id'=>array('in',$id),'status'=>$status);
        if($status==-1){
            //当status等于-1表示移除商品并且修改name的值
            $data['name'] = array('exp',"concat(name,'_del')");
        }
        return parent::save($data);
    }
}