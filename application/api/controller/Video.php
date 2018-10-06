<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

/**
 * 示例接口
 */
class Video extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = '*';
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = '*';

    public function classes(){
        $list = Db::name('video_classes')
            ->order('weigh desc, id desc')
            ->field('id, name, image')
            ->select();

        $this->success('', $list);
    }

    public function lesson(){
        $list = Db::name('video_lesson')
            ->order('weigh desc, id desc')
            ->field('id, name, image, description')
            ->select();

        $this->success('', $list);
    }

    public function episode(){
        $classes_id = input('post.classes_id');
        $lesson_id = input('post.lesson_id');

        $list = Db::name('video_episode')
            // ->where('video_classes_id', $classes_id)
            // ->where('video_lesson_id', $lesson_id)
            ->order('id desc')
            ->field('episode, title')
            ->select();

        $this->success('', $list);
    }

}
