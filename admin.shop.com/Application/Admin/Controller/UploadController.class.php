<?php
/**
 * Created by PhpStorm.
 * User: yu
 * Date: 2016/1/13
 * Time: 0:14
 */

namespace Admin\Controller;


use Think\Controller;

class UploadController extends Controller
{

    public function index(){
        $dir = I('post.dir');  //获取浏览器指定的服务
        $config = array(
            'rootPath'     => './Uploads/', //保存根路径
            'savePath'     => $dir.'/', //保存路径
            'driver'       => '', // 文件上传驱动
            'driverConfig' => array(

            ), // 上传驱动配置
        );
        $uploader = new Upload($config);
        $result = $uploader->uploadOne($_FILES['Filedata']);
        if($result!==false){
            //将上传后的路径发送给浏览器
            echo $result['savepath'].$result['savename']; //保存到upyun上的地址
        }else{
            echo $uploader->getError();
        }

    }

}