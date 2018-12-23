define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'video/episode/index',
                    add_url: 'video/episode/add',
                    edit_url: 'video/episode/edit',
                    del_url: 'video/episode/del',
                    multi_url: 'video/episode/multi',
                    table: 'tp_video_episode',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'video_classes.name', title: __('Video_classes_id')},
                        {field: 'video_lesson.name', title: __('Video_lesson_id')},
                        {field: 'episode', title: __('Episode')},
                        {field: 'title', title: __('Title')},
                        {field: 'videofile', title: __('Videofile'), visible: false},
                        {field: 'guide_melody_file', title: __('Guide_melody_file'), visible: false},
                        {field: 'accompaniment_file', title: __('Accompaniment_file'), visible: false},
                        {field: 'lyric_file', title: __('Lyric_file'), visible: false},
                        {field: 'status', title: __('Status'), visible:false, searchList: {"0":__('Status 0'),"1":__('Status 1')}},
                        {field: 'status_text', title: __('Status'), operate:false},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, buttons: [
                                {name: 'question', text: '知识点', title: '知识点', icon: 'fa fa-list', classname: 'btn btn-xs btn-primary btn-dialog', url: 'video/question/add'},
                                {name: 'singledance', text: '单一舞蹈', title: '单一舞蹈', icon: 'fa fa-list', classname: 'btn btn-xs btn-primary', url: 'video/singledance/index'}
                            ], events: Table.api.events.operate, formatter: Table.api.formatter.operate},
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});