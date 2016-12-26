Vue.component('query-page',{
	props:['apiUrl','query','queryLoad'],
	// props: {
	//     query: {
	//     	queryBegin: '0',
 //            queryCount: '10',
 //            pageCount: '0'
	//     }
	// },
	template : '<div :class="{\'col-md-offset-3\':query.pageCount>5,\'col-md-offset-4\':query.pageCount<=6}">'+
		'<nav>'+
			'<ul class="pagination">'+
				'<li><a href="#" @click="previousPage"> &laquo;</a></li>'+
						'<li v-for="n in query.pageCount" v-if="n<5" :class="{active: Math.ceil(query.queryBegin / query.queryCount) === n-1}" ><a href="#" @click="selectPage(n)">{{n}}</a></li>'+
						'<li v-for="n in query.pageCount" v-if="n==5 && query.pageCount>10"><a href="#">...</a></li>'+
						'<li v-for="n in query.pageCount" v-if="n==5 && query.pageCount>=5 && query.pageCount<=10"><a href="#" @click="selectPage(n)">5</a></li>'+
						'<li v-for="n in query.pageCount" v-if="n-6 >= 0 && n>query.pageCount-5" :class="{active: Math.ceil(query.queryBegin / query.queryCount) === n-1}" ><a href="#" @click="selectPage(n)">{{n}}</a></li>'+
				'<li><a href="#" @click="nextPage">&raquo;</a></li>'+
				'<div v-if="query.pageCount > 10" class="col-xs-2">'+
					'<div class="input-group">'+
				      '<input id="pageIndex" type="text" class="form-control _inputNumber" placeholder="页码">'+
				      '<span class="input-group-btn">'+
				        '<button class="btn btn-primary" type="button" @click="jumpPage">跳转</button>'+
				      '</span>'+
				    '</div>'+
			    '</div>'+
			'</ul>'+
		'</nav>'+
	'</div>',
	beforeCreate() {
	        // 加载校验插件
	        defaultInputValidator()
	    },
    methods: {
        // 选择页
        selectPage: function(currentPage) {
            var vm = this
            vm.query.queryBegin = (Number(currentPage) - 1) * Number(vm.query.queryCount)
            vm.queryLoad(vm.apiUrl, vm.query)
        },
        // 页跳转
        jumpPage: function() {
            var vm = this
            vm.selectPage($('#pageIndex').val())
        },
        // 前一页
        previousPage: function() {
            var vm = this
            if (Number(vm.query.queryBegin) - Number(vm.query.queryCount) >= 0) {
                vm.query.queryBegin = Number(vm.query.queryBegin) - Number(vm.query.queryCount)
                vm.queryLoad(vm.apiUrl, vm.query)
            }
        },
        // 后一页
        nextPage: function() {
            var vm = this
            if (Math.ceil(Number(vm.query.queryBegin) / Number(vm.query.queryCount)) < vm.query.pageCount - 1) {
                vm.query.queryBegin = Number(vm.query.queryBegin) + Number(vm.query.queryCount)
                vm.queryLoad(vm.apiUrl, vm.query)
            }
        }
    }

})



// $(function () {
// 	//校验控件
// 	defaultInputValidator();
// });
// function jumpPage(){
// 	selectPage($('#pageIndex').val()-1);
// }