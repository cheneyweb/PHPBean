Vue.component('ztree',{
	props:['treeName','treeId','treeValueId'],
	template : '<div>'+
                    '<hr/>'+
                    '<h5>{{treeName}}</h5>'+
                    '<input type="hidden" :id="treeValueId" />'+
                    '<ul :id="treeId" class="ztree"></ul>'+
                '</div>'
})


