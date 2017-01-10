var VueBase = Vue.extend({
    methods: {
            /**
             * 通用查询操作方法集
             * beforeQuery和afterQuery提供重写拓展
             */
            beforeQuery: function(){},
            afterQuery: function(respObj){},
            queryLoad: function() {
                var vm = this
                // 设置query.bean和query.id,以便查询
                vm.query.bean = vm.bean
                vm.query.id = null
                // =====查询前置操作=====
                vm.beforeQuery()

                vm.$http.post(vm.queryUrl, vm.query)
                    .then((sucResp) => {
                        var respObj = ($.parseJSON($.trim(sucResp.data)))
                        vm.respMsg = respObj.respMsg
                        if(vm.respMsg == 'Y'){
                            // 获取返回数据列表
                            vm.entityList = respObj.result
                            // 获取返回查询条件
                            vm.query =  respObj.query
                            // =====查询后置操作=====
                            vm.afterQuery(respObj)
                        }
                    }, (errResp) => {
                        vm.respMsg = errResp.data
                    });
            },
            /**
             * [新增前置操作（可重写）]
             */
            beforeAdd: function(){},
            /**
             * [新增后置操作（可重写）]
             */
            afterAdd: function(){},
            /**
             * [通用新增操作]
             * @param modalId [弹窗ID]
             */
            add: function(modalId) {
                var vm = this
                // 设置entity.bean和entity.id,以便新增
                vm.entity.bean = vm.bean
                vm.entity.id = null
                // =====新增前置操作=====
                vm.beforeAdd()

                vm.$http.post(vm.addUrl, vm.entity)
                    .then((sucResp) => {
                        var respObj = ($.parseJSON($.trim(sucResp.data)))
                        vm.respMsg = respObj.respMsg
                        if (vm.respMsg == 'Y') {
                            // 隐藏弹窗，重新查询
                            if(modalId != null){
                                $('#' + modalId).modal('hide')
                                vm.queryLoad()
                            }
                            // =====新增后置操作=====
                            vm.afterAdd()
                        }
                    }, (errResp) => {
                        vm.respMsg = errResp.data
                    });
            },
            /**
             * [更新弹窗前置操作（可重写）]
             */
            beforeUpdateModal: function(){},
            /**
             * [更新弹窗后置操作（可重写）]
             */
            afterUpdateModal: function(){},
            /**
             * [通用更新弹窗]
             * @param modalId [弹窗ID]
             * @param id [更新项ID]
             */
            updateModal: function(modalId,id) {
                var vm = this
                // 设置查询的ID
                vm.query.bean = vm.bean
                vm.query.id = id
                // =====更新弹窗前置操作=====
                vm.beforeUpdateModal()

                vm.$http.post(vm.updateViewUrl, vm.query)
                    .then((sucResp) => {
                        var respObj = ($.parseJSON($.trim(sucResp.data)))
                        vm.respMsg = respObj.respMsg
                        if(vm.respMsg == 'Y'){
                            // 获取详情数据
                            vm.entity = $.parseJSON($.trim(sucResp.data))
                            // 更换提交按钮
                            $('#updateBtn').show()
                            $('#addBtn').hide()
                            // 修改主题文字
                            $('#addModalLabel').html($('#addModalLabel').html().replace('新增','编辑'))
                            // =====更新弹窗后置操作=====
                            vm.afterUpdateModal()
                            // 显示更新弹窗
                            $('#' + modalId).modal()
                        }
                    }, (errResp) => {
                        vm.respMsg = errResp.data
                    });
            },
            /**
             * [更新前置操作]
             */
            beforeUpdate: function(){},
            /**
             * [更新后置操作]
             */
            afterUpdate: function(){},
            /**
             * [通用更新操作]
             * @param modalId [弹窗ID]
             */
            update: function(modalId) {
                var vm = this
                vm.entity.bean = vm.bean
                // =====更新前置操作=====
                vm.beforeUpdate()

                vm.$http.post(vm.updateUrl, vm.entity)
                    .then((sucResp) => {
                        var respObj = ($.parseJSON($.trim(sucResp.data)))
                        vm.respMsg = respObj.respMsg
                        if(vm.respMsg == 'Y'){
                            // 隐藏弹窗，重新查询
                            if(modalId != null){
                                $('#' + modalId).modal('hide');
                                vm.queryLoad()
                            }
                            // =====更新后置操作=====
                            vm.afterUpdate()
                        }
                    }, (errResp) => {
                        vm.respMsg = errResp.data
                    });
            },
            /**
             * [通用根据ids批量删除]
             */
            deleteByIds: function() {
                var vm = this
                vm.$http.post(vm.deleteUrl, {"ids":vm.ids})
                    .then((sucResp) => {
                        var respObj = ($.parseJSON($.trim(sucResp.data)))
                        vm.respMsg = respObj.respMsg
                        if(vm.respMsg == 'Y'){
                            // 重新查询
                            vm.queryLoad()
                        }
                    }, (errResp) => {
                        vm.respMsg = errResp.data
                    });
            },
            /**
             * [通用复选框全选]
             * @param [event] [操作对象]
             */
            checkAll: function(event) {
                var vm = this
                vm.ids = []
                //实现全选
                if (event.target.checked) {
                    vm.entityList.forEach(function(item) {
                        vm.ids.push(item.id);
                    });
                }
            },
            /**
             * [通用勾选树节点]
             * @param treeId [树ID]
             */
            checkNode: function(treeId){
                var vm = this
                if(vm.entity.permissionIds.length > 0 && vm.entity.permissionIds != 0){
                    var treeObj=$.fn.zTree.getZTreeObj(treeId);
                    var ids = vm.entity.permissionIds.split(',');
                    for(var i = 0; i < ids.length; i++ ) {
                        treeObj.checkNode(treeObj.getNodeByParam('id',ids[i]), true );
                    }

                    var checkedNodes=treeObj.getCheckedNodes(true);
                    var checkedCodes = null;
                    for(var i=0; i < checkedNodes.length; i++) {
                        checkedCodes += checkedNodes[i].id;
                        if(i != checkedNodes.length -1){
                            checkedCodes += ',';
                        }
                    }
                    $('#permissionIds').val(checkedCodes);
                }
            },
            /**
             * [通用跳转新页面]
             * @param htmlUrl       [HTML路径]
             * @param id            [ID参数]
             * @param event         [触发事件]
             * @param isNeedConfirm [是否需要确认]
             */
            showHtml: function(htmlUrl,id,event,isNeedConfirm){
                if(isNeedConfirm){
                    $('div[id$="Modal"]').modal('hide')
                    alert('操作成功')
                }
                // 设置跳转参数
                if(event != null){
                    event.target.href = event.target.href.split('#')[0] + '#' + id
                }
                $('#content').load(htmlUrl,function(){
                    // 页面加载完成之后执行
                    afterViewLoad()
                })
            },
            /**
             * [显示弹窗前置操作（可重写）]
             */
            beforeShowModal: function(){},
            /**
             * [显示弹窗后置操作（可重写）]
             */
            afterShowModal: function(){},
            /**
             * [通用显示弹窗]
             * @param modalId [弹窗ID]
             * @param htmlUrl [HTML路径]
             * @param id      [更新项ID]
             * @param event   [触发事件]
             */
            showModal: function(modalId,htmlUrl,id,event) {
                var vm = this
                // 设置查询的ID
                vm.query.bean = vm.bean
                vm.query.id = id

                // 设置跳转参数
                if(event != null){
                    event.target.href = event.target.href.split('#')[0] + '#' + id
                }

                // =====显示弹窗前置操作=====
                vm.beforeShowModal()

                // 清空其他的弹窗div的内容
                $('div[id$="Content"]').each(function(){
                    if($(this).attr('id') != modalId+'Content'){
                        $(this).html('');
                    }
                });
                // 隐藏详情弹出框
                $('#'+modalId).modal('hide');
                // 获取详情页面，并对其修饰
                $('#'+modalId+'Content').load(htmlUrl,{'bean':vm.bean,'id':id},function(){
                    $('#'+modalId+'Content').find("button:contains('返回')").remove();// 去掉返回按钮
                    $('#'+modalId+'Content' + ' .sub-header').remove();// 去掉标题

                    // =====显示弹窗后置操作=====
                    vm.afterShowModal()

                    // 显示详情弹出框
                    $('#'+modalId).modal('show');
                });

            }
        }
})
