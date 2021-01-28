import Vue from 'vue'
import Vuex from 'vuex'
import App from './App'
import io from './js_sdk/hyoga-uni-socket_io/uni-socket.io';
import config from 'config/config.js';
import {
	request
} from 'config/request.js'
import {
	store
} from 'store/store.js';
import socket from 'config/socket.js'


import axios from 'axios';
import uniPopupMessage from '@/components/uni-popup/uni-popup-message.vue'
import uniPopupDialog from '@/components/uni-popup/uni-popup-dialog.vue'
import uniPopupShare from '@/components/uni-popup/uni-popup-share.vue'


Vue.config.productionTip = false
Vue.use(Vuex);
Vue.component("uniPopupMessage", uniPopupMessage);
Vue.component("uniPopupDialog", uniPopupDialog);
Vue.component("uniPopupShare", uniPopupShare);
App.mpType = 'app'



Vue.prototype.web_config = config;
Vue.prototype.$request = request;
Vue.prototype.$axios = axios;
Vue.prototype.$state = function(key) {
	return this.$store.state[key];
}

socket.connect();

Vue.prototype.$socket = socket;
Vue.prototype._socket = socket._;
Vue.prototype.get_location = function(open_id,cb=function(){}) {
	let _this = this;
	uni.getLocation({
		success(res) {
			let {
				latitude,
				longitude
			} = res;
			socket._.send({
				data: JSON.stringify({
					action: 'upload_location',
					lat: latitude,
					lon: longitude,
					open_id,
				}),
				success(){
					console.log(123)
					typeof cb === 'function' && cb()
				}
			})
		}
	});
}


const app = new Vue({
	...App,
	store,

})
app.$mount()
