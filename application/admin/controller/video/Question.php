<?php

namespace app\admin\controller\video;

use app\common\controller\Backend;

/**
 * 知识点
 *
 * @icon fa fa-circle-o
 */
class Question extends Backend
{
    
    /**
     * TpVideoQuestion模型对象
     * @var \app\admin\model\VideoQuestion
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('VideoQuestion');

    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    
     /**
     * 添加
     */
    public function add()
    {
        // 判断是添加还是修改
        $episode_id = input('param.ids');
        $question = model('video_question')->where('episode_id', $episode_id)->find();
        if($question) $this->redirect('/admin/video/question/edit', ['ids' => $question['id']]);

        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                if ($this->dataLimit && $this->dataLimitFieldAutoFill) {
                    $params[$this->dataLimitField] = $this->auth->id;
                }
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = basename(str_replace('\\', '/', get_class($this->model)));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.add' : true) : $this->modelValidate;
                        $this->model->validate($validate);
                    }
                    // 替换
                    $params['answer'] = trim(str_replace('，', ',', $params['answer']), ',');

                    $result = $this->model->allowField(true)->save($params);
                    if ($result !== false) {
                        $this->success();
                    } else {
                        $this->error($this->model->getError());
                    }
                } catch (\think\exception\PDOException $e) {
                    $this->error($e->getMessage());
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        return $this->view->fetch();
    }
}
