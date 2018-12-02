<?php

namespace app\api\controller;

use app\common\controller\Api;
use think\Db;

/**
 * 示例接口
 */
class Audio extends Api
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
        $list = Db::name('audio_classes')
            ->order('weigh desc, id desc')
            ->field('id, name, image')
            ->select();

        $this->success('', $list);
    }

    // 课程
    public function lesson(){
        $list = Db::name('audio_lesson')
            ->order('weigh desc, id desc')
            ->field('id, name, image, description')
            ->select();

        $this->success('', $list);
    }

    // 音频列表
    public function audioList(){
        $lesson_id = input('post.lesson_id');

        $list = Db::name('audio_episode')
            ->where('audio_lesson_id', $lesson_id)
            ->where('status', 1)
            ->order('id desc')
            ->field('id, title, audiofile, timelong, singer, album')
            ->select();

        $this->success('', $list);
    }

    // 集数
    public function episode(){
        $lesson_id = input('post.lesson_id');

        $list = Db::name('audio_episode')
            ->where('audio_classes_id', $classes_id)
            ->where('audio_lesson_id', $lesson_id)
            ->where('status', 1)
            ->order('id desc')
            ->field('id, episode, title, videofile, guide_melody_file, accompaniment_file, lyric_file')
            ->select();

        $this->success('', $list);
    }

    // 单只舞蹈
    public function singledance(){
        $audio_episode_id = input('post.audio_episode_id');

        $list = Db::name('audio_singledance')
            ->where('audio_episode_id', $audio_episode_id)
            ->field('title, video')
            ->find();

        $this->success('', $list);
    }
}
