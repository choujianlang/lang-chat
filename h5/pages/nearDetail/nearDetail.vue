<template>
	<view>
		<!-- 单行内容显示 -->
		<uni-list>
			<uni-list-item :thumb="user.avatarUrl" class="list" rightText="头像" thumbSize="lg"></uni-list-item>
			<uni-list-item class="list" title="昵称" :rightText="user.nickName"></uni-list-item>
			<uni-list-item class="list" title="性别" :rightText="user.gender == 1?'男':'女'"></uni-list-item>
			<uni-list-item class="list" title="个性签名" :rightText="user.sign_desc"></uni-list-item>
		</uni-list>
		<view v-if="is_me">
			<view style="margin-top: 30rpx;">
				<button type="primary">发起聊天</button>
			</view>
			<view style="margin-top: 30rpx;">
				<button type="default">添加好友</button>
			</view>
		</view>
	</view>

</template>
<style>
	.update-input {
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

	.update-input .input-text {
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
		components: {},
		data() {
			return {
				user: {},
			}
		},
		computed: {
			is_me() {
				return this.$store.state.user_status.open_id == this.user.open_id
			},
		},
		mounted() {

		},
		onLoad(option) {
			let {
				open_id
			} = option;
			// console.log(option)
			this.get_user_info(open_id);
		},
		computed: {

		},
		methods: {
			get_user_info(open_id) {
				uni.showLoading({
					mask: true,
					title: '加载中',
				})

				let _this = this;
				_this.$request({
					action: 'get_user',
					data: {
						open_id,
					},
					success(r) {
						let {
							data: res
						} = r;
						_this.user = res.data;
						uni.hideLoading();
					}
				});
			}
		}
	}
</script>
