<template>
	<view class="content">
		<uni-list class="friends-list">
			<view class="sort-bg">A</view>
			<uni-list-item thumb="https://pic.rmb.bdstatic.com/932ca9934baf734b3160fc76bc761dcf.jpeg" title="猫仔" thumbSize="lg"></uni-list-item>
			<uni-list-item thumb="https://pic.rmb.bdstatic.com/932ca9934baf734b3160fc76bc761dcf.jpeg" title="猫仔" thumbSize="lg"></uni-list-item>
			<uni-list-item thumb="https://pic.rmb.bdstatic.com/932ca9934baf734b3160fc76bc761dcf.jpeg" title="猫仔" thumbSize="lg"></uni-list-item>
			<uni-list-item thumb="https://pic.rmb.bdstatic.com/932ca9934baf734b3160fc76bc761dcf.jpeg" title="猫仔" thumbSize="lg"></uni-list-item>
			<view class="sort-bg">B</view>
			<uni-list-item thumb="https://pic.rmb.bdstatic.com/932ca9934baf734b3160fc76bc761dcf.jpeg" title="猫仔" thumbSize="lg"></uni-list-item>
			<uni-list-item thumb="https://pic.rmb.bdstatic.com/932ca9934baf734b3160fc76bc761dcf.jpeg" title="猫仔" thumbSize="lg"></uni-list-item>
		</uni-list>
		
	</view>
</template>

<script>
	export default {
		data() {
			return {
				title: 'test'
			}
		},
		onLoad() {

		},
		methods: {

		}
	}
</script>

<style scoped>
	/deep/ .friends-list .uni-list--lg{
		border-radius: 15rpx;
	}
	
	.sort-bg{
		width: 100%;
		height: 50rpx;
		background-color: #EDEDED;
		padding-left: 30rpx;
		line-height: 50rpx;
		color: #a8a8a8;
		font-size: 16rpx;
	}
</style>
