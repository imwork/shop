<?php
/**
 * Created by PhpStorm.
 * User: yu
 * Date: 2016/1/10
 * Time: 21:21
 */

namespace Admin\Controller;


use Think\Controller;

class BaseController extends Controller
{

    public $model;

    public function _initialize(){
        $this->model=D(CONTROLLER_NAME);
    }


    public function index(){
        //创建模型对象

        //查询数据库列表

        $keyword = I('get.keyword','');
        $wheres=array();
        if(!empty($keyword)){
            $wheres['name']=array('like',"{$keyword}%");
        }
        $getPageResult = $this->model->getPageResult($wheres);
        //       分配数据到页面
        $this->assign($getPageResult);
        //URL保存到cookie中
        cookie('__FORWARD__',$_SERVER['REQUEST_URI']);
        $this->assign('meta_title',$this->meta_title);
        //选择视图
        $this->display('index');
    }

    /**
     * 添加商品
     */
    public function add(){
        if(IS_POST){

            //使用create方法收集请求验证
            if($this->model->create()!==false){
                //使用add方法添加数据
                if($this->model->add()!==false){
                    //添加成功返回到当前页
                    $this->success('添加成功!',cookie('__FORWARD__'));
                    return;
                }
            }
            //使用自定义函数show_model_error显示错误信息
            $this->error('操作失败'.show_model_error($this->model));

        }else{
            $this->assign('meta_title','添加'.$this->meta_title);
            $this->_edit_view_before();
            //选择视图
            $this->display('edit');
        }
    }

    /**
     * 商品移除
     * @param $id
     */
//    public function remove($id){
//        $Model = D('Supplier');
//        //使用自定义方法remove删除
//        $result = $Model->remove($id);
//        if($result!==false){
//            $this->success('删除成功',U('index'));
//        }else{
//            $this->error('删除失败'.show_model_error($Model));
//        }
//    }
    /**
     * 商品编辑
     */
    public function edit($id){
        if(IS_POST){
            //使用create方法收集请求保存
            if($this->model->create()!==false){
                //使用save方法修改
                if($this->model->save()!==false){
                    //编辑成功返回到当前页
                    $this->success('编辑成功',cookie('__FORWARD__'));
                    return;
                }
            }
            $this->error('操作失败'.show_model_error($this->model));

        }else{
            //根据ID查询一条数据
            $row=$this->model->find($id);
            //分配到页面  回显
            $this->assign($row);
            $this->assign('meta_title','编辑'.$this->meta_title);
            $this->_edit_view_before();
            $this->display('edit');
        }
    }

    /**
     * @param $id
     * @param int $status
     * 更改显示状态和移除商品
     */
    public function changeStatus($id,$status=-1){
        //调用model中的changeStatus方法
        $result = $this->model->changeStatus($id,$status);
        if($result!==false){
            //操作成功返回到当前页
            $this->success('操作成功',cookie('__FORWARD__'));
        }else{
            $this->error('操作失败'.show_model_error($this->model));
        }
    }

    /**
     * 钩子方法
     */
    protected function _edit_view_before(){

    }
}