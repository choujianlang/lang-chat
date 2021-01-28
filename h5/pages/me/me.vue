<template>
	<view>
		<!-- 单行内容显示 -->
		<uni-list>
			<uni-list-item :thumb="user.avatarUrl" class="list" rightText="头像"
			 thumbSize="lg"></uni-list-item>
			<uni-list-item class="list" title="昵称" :rightText="user.nickName"></uni-list-item>
			<uni-list-item class="list" title="性别" :rightText="user.gender == 1?'男':'女'"></uni-list-item>
			<uni-list-item class="list" title="个性签名" clickable :rightText="user.sign_desc" :showArrow='!!is_auth' @click="update_user"></uni-list-item>
		</uni-list>
		<button type="primary" @getuserinfo="get_user_info()" open-type="getUserInfo" class="login-btn" v-if="!is_auth">授权登陆</button>
		
		<uni-popup ref="popup" type="dialog">
		    <uni-popup-dialog type="info" mode="input" :value="user.sign_desc" placeholder="请输入" title="修改" message="成功消息" :duration="2000" :before-close="true" @close="close" @confirm="confirm"></uni-popup-dialog>
		</uni-popup>
		
	</view>

</template>
<style>
	.update-input{
		width: 80%;
		height: 300rpx;
		position: absolute;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		margin: auto;
		background-color: #fff;
		border: 1rpx solid rgb(180, 180, 180);
		border-radius: 5rpx;
	}
	.update-input .input-text{
		width: 60%;
		border: 1px solid #999999;
	}
	
	.list {
		margin-top: 10rpx;
	}

	.login-btn {
		margin-top: 30rpx;
	}
</style>
<script>
	export default {
		components:{
		},
		data() {
			return {
				
			}
		},
		mounted() {
			
		},
		onLoad() {},
		computed: {
			is_auth() {
				return this.$store.state.user_status.is_auth;
			},
			user(){
				// console.log(this.$state('user'))
				return this.$state('user')
			},
		},
		methods: {
			close(done){
				done();
			},				
			confirm(done,value){
				if(value.length >= 20){
					uni.showToast({
						title:"长度不能超过20个字符",
						icon:'none',
						mask:true
					})
					return false;
				}
				
				let _this = this;
				this.$request({
					action:'update_user_detail',
					data:{
						key:'sign_desc',
						value,
						openid:_this.$state('user_status').open_id,
					},
					success(r){
						let {data:res} = r;
						
						if(res.isSuccess){
							_this.$store.commit('set_user',{sign_desc:value});
							uni.showToast({
								title:res.msg,
								icon:'success',
								mask:true
							})
							done();
						}
						
					}
				})
			},
			update_user(){//修改用户信息
				if(this.is_auth){
					this.$refs.popup.open()
				}
				
			},
			onClick(e) {
				alert(1)
			},
			get_user_info(e) {
				let _this = this;
				uni.login({
					provider: 'weixin',
					success: function(loginRes) {
						// console.log(loginRes)
						// loginRes 实际输出的是  {"errMsg":"login:ok","code":"0230gxqx1BgRRh0afIox1UAOqx10gxqF"}  
						// 并不存在 authResult 属性。  
						// 微信开发者工具此处提示 获取 wx.getUserInfo 接口后续将不再出现授权弹窗，请注意升级  
						let {
							code
						} = loginRes;
						uni.getUserInfo({
							provider: 'weixin',
							withCredentials: true,
							success: function(res) {
								// console.log(_this.$store.state.user_status)
								_this.$request({
									action:'get_user_detail',
									data:{
										encryptedData: res.encryptedData,
										iv: res.iv,
										session_key: _this.$store.state.user_status.session_key,
									},
									method:'POST',
									success(r){
										let {data:res} = r;
										if(res.isSuccess){
											_this.get_location(res.data.openId);
											_this.$store.commit('set_user_status',{
												is_auth:1
											})
											_this.$store.commit('set_user',res.data)
											uni.showToast({
												title:res.msg,
												icon:'success',
												mask:true
											})
										}else{
											uni.showToast({
												title:res.msg,
												icon:'none',
											})
										}
									}
								});
							},
							fail: function(res) {
								// 这里res = {"errMsg":"getUserInfo:fail scope unauthorized"}   
								// console.log('res=' + JSON.stringify(res))
								uni.showToast({
									title: '授权失败',
									icon: 'none'
								})
							}
						});
					},
					fail: function(es) {
						// console.log('fail')
						// console.log(es)
					}
				});
			}
		}
	}
</script>
