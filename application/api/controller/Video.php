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

    // 班级
    public function classes(){
        $list = Db::name('video_classes')
            ->order('weigh desc, id desc')
            ->field('id, name, image')
            ->select();

        $this->success('', $list);
    }

    // 课程
    public function lesson(){
        $list = Db::name('video_lesson')
            ->order('weigh desc, id desc')
            ->field('id, name, image, description')
            ->select();

        $this->success('', $list);
    }

    // 集数
    public function episode(){
        $classes_id = input('post.classes_id');
        $lesson_id = input('post.lesson_id');

        $list = Db::name('video_episode')
            ->where('video_classes_id', $classes_id)
            ->where('video_lesson_id', $lesson_id)
            ->where('status', 1)
            ->order('id desc')
            ->field('id, episode, title, videofile, guide_melody_file, accompaniment_file, lyric_file')
            ->select();

        $this->success('', $list);
    }

    // 单只舞蹈
    public function singledance(){
        $video_episode_id = input('post.video_episode_id');

        $list = Db::name('video_singledance')
            ->where('video_episode_id', $video_episode_id)
            ->field('title, image, video')
            ->find();

        $this->success('', $list);
    }
}
