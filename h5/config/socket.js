export default {
	_:null,
	connect() {
		this._ = uni.connectSocket({
			url: 'wss://x11132.top:9118',
			success() {
				console.log("websocket连接成功")
			}
		});
	},
	send(data){
		let _this = this;
		_this._.onOpen(function(r){
			_this._.send({
				data,
				fail(r){
					console.log(r);
				},
			})
		})
	},
	msg(cb=function(){}){
		this._.onMessage(function(res){
			cb(res);
		})
	}
}
