define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'audio/episode/index',
                    add_url: 'audio/episode/add',
                    edit_url: 'audio/episode/edit',
                    del_url: 'audio/episode/del',
                    multi_url: 'audio/episode/multi',
                    table: 'audio_episode',
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
                        {field: 'audio_classes_id', title: __('Audio_classes_id')},
                        {field: 'audio_lesson_id', title: __('Audio_lesson_id')},
                        {field: 'episode', title: __('Episode')},
                        {field: 'title', title: __('Title')},
                        {field: 'audiofile', title: __('Audiofile')},
                        {field: 'accompaniment_file', title: __('Accompaniment_file')},
                        {field: 'lyric_file', title: __('Lyric_file')},
                        {field: 'status', title: __('Status'), visible:false, searchList: {"0":__('Status 0'),"1":__('Status 1')}},
                        {field: 'status_text', title: __('Status'), operate:false},
                        {field: 'createtime', title: __('Createtime'), operate:'RANGE', addclass:'datetimerange', formatter: Table.api.formatter.datetime},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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