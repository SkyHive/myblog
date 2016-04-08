<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/14 0014
 * Time: 17:10
 */
namespace Admin\Controller;
use Think\Controller;
class ContentController extends Controller {
    #文章列表
    public function index() {
        $Content = M('Content');
        $list = $Content->select();
        $this->assign('list', $list);
        $this->display(); // 输出模板
    }

    #文章添加
    public function addContent() {
        if (isset($_POST['title'])){
            $Content = D('Content');
            if (!$Content->create()){     // 如果创建失败 表示验证没有通过 输出错误提示信息
                $return['success'] = false;
                $return['code'] = 5001;
                $return['msg'] = $Content->getError();
                $this->ajaxReturn($return);die;
            }else{     // 验证通过 可以进行其他数据操作
                $ok = $Content->add();
                if ($ok) {
                    $return['success'] = true;
                    $return['code'] = 200;
                    $return['msg'] = '添加成功！';
                    $this->ajaxReturn($return);die;
                } else {
                    $return['success'] = false;
                    $return['code'] = 5002;
                    $return['msg'] = '添加失败！';
                    $this->ajaxReturn($return);die;
                }
            }
        }
        $Category = M('Category');
        $categoryArr = $Category->field('id,name,remark')->select();
        $this->assign('categoryArr', $categoryArr);
        $this->assign('captionTitle', '文章列表');
        $this->display();
    }

    #文章修改
    public function altContent() {
        if (isset($_POST['id']) && isset($_POST['title'])) {
            $Content = D('Content');
            if (!$Content->create()){     // 如果创建失败 表示验证没有通过 输出错误提示信息
                $return['success'] = false;
                $return['code'] = 5001;
                $return['msg'] = $Content->getError();
                $this->ajaxReturn($return);die;
            }else{     // 验证通过 可以进行其他数据操作
                $ok = $Content->save();
                if ($ok) {
                    $return['success'] = true;
                    $return['code'] = 200;
                    $return['msg'] = '更新成功！';
                    $this->ajaxReturn($return);die;
                } else {
                    $return['success'] = false;
                    $return['code'] = 5002;
                    $return['msg'] = '更新失败！';
                    $this->ajaxReturn($return);die;
                }
            }
        }
        //显示修改页面
        if (isset($_POST['aid'])) {
            $Content = M('Content');
            $where['id'] = intval($_POST['aid']);
            $list = $Content->field('id,title,content')->where($where)->find();
            $this->assign('list', $list);
            $this->display();die;
        }
        $return['success'] = false;
        $return['code'] = 5002;
        $return['msg'] = '更新失败！';
        $this->ajaxReturn($return);die;
    }

    #文章删除
    public function delContent() {
        if (isset($_GET['aid'])) {
            $where['id'] = intval($_GET['aid']);
            $Content = M('Content');
            $ok = $Content->where($where)->delete();
            if ($ok) {
                $return['success'] = true;
                $return['code'] = 200;
                $return['msg'] = '删除成功！';
                $this->ajaxReturn($return);die;
            } else {
                $return['success'] = false;
                $return['code'] = 5002;
                $return['msg'] = '删除失败！';
                $this->ajaxReturn($return);die;
            }
        } else {
            $return['success'] = false;
            $return['code'] = 5003;
            $return['msg'] = '数据错误！';
            $this->ajaxReturn($return);die;
        }
    }
}