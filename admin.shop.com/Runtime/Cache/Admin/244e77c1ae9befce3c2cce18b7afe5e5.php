<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: brand_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - <?php echo ($meta_title); ?> </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="http://admin.shop.com/Public/Admin/css/general.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/main.css" rel="stylesheet" type="text/css" />
<link href="http://admin.shop.com/Public/Admin/css/common.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="http://admin.shop.com/Public/Admin/zTree/css/zTreeStyle/zTreeStyle.css" type="text/css">

</head>
<body>
<h1>
    <span class="action-span"><a href="<?php echo U('index');?>"><?php echo mb_substr($meta_title,2,null,'utf-8');?>列表</a></span>
    <span class="action-span1"><a href="#">ECSHOP 管理中心</a></span>
    <span id="search_id" class="action-span1"> - <?php echo ($meta_title); ?> </span>
    <div style="clear:both"></div>
</h1>

    <div class="main-div">
        <form method="post" action="<?php echo U();?>">
            <table cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    <td class="label">分类名称</td>
                    <td>
                        <input type='text' name='name' maxlength='60' value='<?php echo ($name); ?>'/> <span
                            class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">父分类</td>
                    <td>
                        <!--保存父分类的ID-->
                        <input type="hidden"  class="parent_id" name="parent_id" value="0">
                        <!--存放父分类名字.-->
                        <input type='text' class="parent_name" name='parent_name' maxlength='60' value='默认为顶级分类' disabled="disabled"/>
                        <span class="require-field">*</span>
                    </td>
                </tr><tr>
                    <td class="label"></td>
                    <td>
                        <style type="text/css">
                            .ztree{
                                margin-top: 10px;
                                border: 1px solid #617775;
                                background: #f0f6e4;
                                width: 220px;
                                height: auto;
                                overflow-y: scroll;
                                overflow-x: auto;
                            }
                        </style>
                        <ul id="treeDemo" class="ztree"></ul>
                    </td>
                </tr>
                <tr>
                    <td class="label">分类简介</td>
                    <td>
                        <textarea name='intro' cols='60' rows='4'><?php echo ($intro); ?></textarea> <span
                            class="require-field">*</span>
                    </td>
                </tr>
                <tr>
                    <td class="label">是否显示</td>
                    <td>
                        <input type='radio' class='status' name='status' value='1'/> 是<input type='radio' class='status'
                                                                                             name='status' value='0'/> 否
                        <span class="require-field">*</span>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center"><br/>
                        <input type="hidden" name="id" value="<?php echo ($id); ?>"/>
                        <input type="submit" class="button ajax-post" value=" 确定 "/>
                        <input type="reset" class="button" value=" 重置 "/>
                    </td>
                </tr>
            </table>
        </form>
    </div>


<div id="footer">
共执行 1 个查询，用时 0.018952 秒，Gzip 已禁用，内存占用 2.197 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。</div>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery-1.11.2.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/layer/layer.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/jquery.form.js"></script>
<script type="text/javascript" src="http://admin.shop.com/Public/Admin/js/common.js"></script>

    <script type="text/javascript" src="http://admin.shop.com/Public/Admin/zTree/js/jquery.ztree.core-3.5.js"></script>
    <script type="text/javascript">
        $(function(){


            //树结构的设置
            var setting = {
                data: {
                    simpleData: {
                        enable: true,
                        pIdKey: "parent_id",
                    }
                },
                callback: {
                    onClick: function(event, treeId, treeNode){  //treeNode就是点击的这个节点
                        //将节点的id(就是数据库中的id) 和节点的name复制给  parent_name和parent_id表单元素
                        $('.parent_name').val(treeNode.name);
                        $('.parent_id').val( treeNode.id);

                    }
                }
            };
            //树的节点数据
            var zNodes =<?php echo ($zNodes); ?>;



            //找到ul,将ul变成一个树结构
            var treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            <?php if(empty($id)): ?>//表示添加,  展开所有的节点
                    treeObj.expandAll(true);
            <?php else: ?>
            //表示编辑. 从treeObj中找到需要被选中的节点对象
            var parent_id = <?php echo ($parent_id); ?>;
            var node = treeObj.getNodeByParam('id',parent_id); //根据parent_id自己的值,找自己对应的节点
            treeObj.selectNode(node); //通过树对象treeObj 选中 找到的节点node

            //将选中的节点的名字和id赋值给表单元素
            $('.parent_name').val(node.name);
            $('.parent_id').val( node.id);<?php endif; ?>


        });
    </script>

<script type="text/javascript">
    $(function(){
        //选中是否显示
        $('.status').val([<?php echo ((isset($status) && ($status !== ""))?($status):1); ?>]);

    });
</script>
</body>
</html>