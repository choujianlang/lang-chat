import config from 'config/config.js';
import {
	store
} from 'store/store.js';

export let request = function({
	data = {},
	action = '',
	header={},
	method = 'GET',
	success = function() {},
	error = function() {}
}) {
	data.do = action;
	let url = config.domain
	
	if(method === 'POST'){
		header['content-type'] = 'application/x-www-form-urlencoded';
	}
	
	uni.request({
		url,
		data,
		header,
		method,
		success,
		fail() {
			error();
			console.log(`action:${action}执行失败`);
		}
	})
}
