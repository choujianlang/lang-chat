<template>
	<view class="content">
		<uni-list :border="true">
			<!-- 自定义右侧内容 -->
			<uni-list-chat :key="v.open_id" v-for="v in near_list" :title="v.nickName" :avatar="v.avatarUrl" :note="v.distance+'米'"
			 clickable @click="click_user(v.openId)">
				<view class="chat-custom-right">
					<view class="user-detail" v-text='v.sign_desc'></view>
				</view>
			</uni-list-chat>

		</uni-list>
		<view v-if="!near_list.length">
			<image src="../../static/images/kong.png"></image>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				title: 'test',
				near_list: [],
			}
		},
		onLoad() {

		},
		onPullDownRefresh() {
			let _this = this;
			_this.get_location(_this.$store.state.user_status.open_id,function(){
				_this.get_near(function(){
					uni.stopPullDownRefresh()
				})
			});
			
		},
		mounted() {
			let _this = this;
			_this.get_location(_this.$store.state.user_status.open_id,function(){
				_this.get_near()
			});
		},
		methods: {
			click_user(open_id) {
				uni.navigateTo({
					url: `/pages/nearDetail/nearDetail?open_id=${open_id}`,
				})
			},
			get_near(cb = function() {}) {

				uni.showLoading({
					title: '加载中',
					mask: true,
				});
				let _this = this;
				_this.$request({
					action: 'get_near',
					data: {
						open_id: _this.$store.state.user_status.open_id,
					},
					success(r) {
						let {
							data: res
						} = r;

						if (res.data) {
							_this.near_list = res.data;
						}
						uni.hideLoading();
						typeof cb === 'function' && cb();
					}
				})
			},
		}
	}
</script>

<style>
	.chat-custom-right {
		padding: 20rpx 35rpx;
		margin: auto 0;
		background-color: #E0EEEE;
		color: #787878;
		border-radius: 10rpx;
		font-size: 26rpx;
	}
</style>
