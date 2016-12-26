Vue.component('modal',{
	props:['modalId','contentId','modalName'],
	template : '<div :id="modalId" class="modal fade" tabindex="-1" role="dialog" >'+
			        '<div class="modal-dialog modal-lg" role="document">'+
			            '<div class="modal-content">'+
			                '<div class="modal-header">'+
			                    '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
			                        '<span aria-hidden="true">&times;</span>'+
			                    '</button>'+
			                    '<h4 class="modal-title">{{modalName}}</h4>'+
			                '</div>'+
			                '<div :id="contentId" class="modal-body"></div>'+
			                '<div class="modal-footer">'+
			                    '<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>'+
			                '</div>'+
			            '</div>'+
			        '</div>'+
			    '</div>'
})


