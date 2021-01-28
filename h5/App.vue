<script>
	export default {

		onLaunch: function() {
			
			

		},
		onShow: function() {
			// console.log('App Show')
		},
		onHide: function() {
			// console.log('App Hide')
		},
		computed:{
			
		},
		methods: {
			bind_socket(openid){
				this._socket.send({
					data:JSON.stringify({
						action:'bind_socket',
						open_id:openid,
					}),
				})
			},
			
			check_user_status() {
				let _this = this;
				uni.showLoading({
					title: '初始化...',
					mask: true,
				});
				uni.login({
					provider: 'weixin',
					success(loginRes) {
						let {
							code
						} = loginRes;

						_this.$request({
							data: {
								code,
							},
							action: 'get_open_id',
							success(r) {
								let {
									data: res
								} = r;
								if (!res.isSuccess) {
									uni.showToast({
										title: res.msg,
										icon: 'none'
									})
								}
								// console.log(res)
								_this.$store.commit('set_user_status', {
									open_id: res.openid,
									is_auth: res.is_auth,
									session_key: res.session_key,
								});
								
								_this.get_user_info(res.openid);
								if(res.is_auth){
									_this.get_location(res.openid);
								}
								_this.bind_socket(res.openid);
								setTimeout(function() {
									uni.hideLoading();
								}, 1000);
							},
						});
					}
				})
			},
			get_user_info(openid) { //获取用户信息
				let _this = this;
				if (this.$store.state.user_status.is_auth) { //已授权
					this.$request({
						action: 'get_user',
						data: {
							openid
						},
						success(r) {
							let {
								data: res
							} = r;
							// console.log(res)
							_this.$store.commit('set_user', res.data);
						}
					});
				}
			},
		},

		mounted() {
			this.check_user_status();
			this.$socket.msg(function(res){
				let {data} = res;
				
			})
		}
	}
</script>

<style>
	/*每个页面公共css */

	.hide {
		display: none;
	}
</style>
