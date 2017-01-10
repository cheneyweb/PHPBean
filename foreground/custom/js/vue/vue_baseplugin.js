var MyPlugin = {}
MyPlugin.install = function(Vue) {
    Vue.prototype.$test = {
        load: function() {
            alert('test plugin')
        }
    }
}
