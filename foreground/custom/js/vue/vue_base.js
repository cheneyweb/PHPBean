var VueBase = Vue.extend({
    methods: {
            /**
             * 通用初始化
             * 设置query.bean和query.id,以便查询
             */
            initQuery: function(id){
                var vm = this
                vm.query.bean = vm.bean
                vm.query.id = id
            },
            initEntity: function(){
                var vm = this
                vm.entity.bean = vm.bean
                vm.entity.id = null
            },
            /**
             * 通用JSON数据接收
             * 将返回的JSON字符串转化成JSON对象，并设置vm的respMsg
             */
            receiveData: function(sucResp){
                var vm = this
                var respObj = ($.parseJSON($.trim(sucResp.data)))
                vm.respMsg = respObj.respMsg
                return respObj;
            },
            /**
             * 通用查询操作方法集
             * beforeQuery和afterQuery提供重写拓展
             */
            beforeQuery: function(){},
            afterQuery: function(respObj){},
            queryLoad: function() {
                var vm = this
                // =====1,查询初始化操作=====
                vm.initQuery(null)
                // =====2,查询前置操作=====
                vm.beforeQuery()

                vm.$http.post(vm.queryUrl, vm.query)
                    .then((sucResp) => {
                        // =====3,接收数据操作=====
                        var respObj = vm.receiveData(sucResp)
                        if(vm.respMsg == 'Y'){
                            // 获取返回数据列表
                            vm.entityList = respObj.result
                            // 获取返回查询条件
                            vm.query =  respObj.query
                            // =====4,查询后置操作=====
                            vm.afterQuery(respObj)
                        }
                    }, (errResp) => {
                        vm.respMsg = errResp.data
                    });
            },
            /**
             * [通用新增操作集]
             * beforeAdd和afterAdd提供重写拓展
             * @param modalId [弹窗ID]
             */
            beforeAdd: function(){},
            afterAdd: function(){},
            add: function(modalId) {
                var vm = this
                // =====1,实体初始化操作=====
                vm.initEntity()
                // =====2,新增前置操作=====
                vm.beforeAdd()

                vm.$http.post(vm.addUrl, vm.entity)
                    .then((sucResp) => {
                        // =====3,接收数据操作=====
                        var respObj = vm.receiveData(sucResp)
                        if (vm.respMsg == 'Y') {
                            // 隐藏弹窗，重新查询
                            if(modalId != null){
                                $('#' + modalId).modal('hide')
                                vm.queryLoad()
                            }
                            // =====4,新增后置操作=====
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
             * beforeUpdateModal和afterUpdateModal提供重写拓展
             * @param modalId [弹窗ID]
             * @param id [更新项ID]
             */
            updateModal: function(modalId,id) {
                var vm = this
                // =====1,查询初始化操作=====
                vm.initQuery(id)
                // =====2,更新弹窗前置操作=====
                vm.beforeUpdateModal()

                vm.$http.post(vm.updateViewUrl, vm.query)
                    .then((sucResp) => {
                        // =====3,接收数据操作=====
                        var respObj = vm.receiveData(sucResp)
                        if(vm.respMsg == 'Y'){
                            // 获取详情数据
                            vm.entity = respObj
                            // 更换提交按钮
                            $('#updateBtn').show()
                            $('#addBtn').hide()
                            // 修改主题文字
                            $('#addModalLabel').html($('#addModalLabel').html().replace('新增','编辑'))
                            // =====4,更新弹窗后置操作=====
                            vm.afterUpdateModal()
                            // 显示更新弹窗
                            $('#' + modalId).modal()
                        }
                    }, (errResp) => {
                        vm.respMsg = errResp.data
                    });
            },
            /**
             * [通用更新操作集]
             * beforeUpdate和afterUpdate提供重写拓展
             * @param modalId [弹窗ID]
             */
            beforeUpdate: function(){},
            afterUpdate: function(){},
            update: function(modalId) {
                var vm = this
                // =====1,实体初始化操作=====
                vm.entity.bean = vm.bean
                // =====2,更新前置操作=====
                vm.beforeUpdate()

                vm.$http.post(vm.updateUrl, vm.entity)
                    .then((sucResp) => {
                        // =====3,接收数据操作=====
                        var respObj = vm.receiveData(sucResp)
                        if(vm.respMsg == 'Y'){
                            // 隐藏弹窗，重新查询
                            if(modalId != null){
                                $('#' + modalId).modal('hide');
                                vm.queryLoad()
                            }
                            // =====4,更新后置操作=====
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
                        var respObj = vm.receiveData(sucResp)
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
             * [通用显示弹窗操作集]
             * beforeShowModal和afterShowModal提供重写拓展
             * @param modalId [弹窗ID]
             * @param htmlUrl [HTML路径]
             * @param id      [更新项ID]
             * @param event   [触发事件]
             */
            beforeShowModal: function(){},
            afterShowModal: function(){},
            showModal: function(modalId,htmlUrl,id,event) {
                var vm = this
                // =====1,查询初始化操作=====
                vm.initQuery(id)

                // 设置跳转参数
                if(event != null){
                    event.target.href = event.target.href.split('#')[0] + '#' + id
                }

                // =====2,显示弹窗前置操作=====
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

                    // =====4,显示弹窗后置操作=====
                    vm.afterShowModal()

                    // 显示详情弹出框
                    $('#'+modalId).modal('show');
                });

            }
        }
})
