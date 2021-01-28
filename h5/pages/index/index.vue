<template>
	<view class="content">
		<uni-list :border="true">
			<uni-list-chat title="猫仔" clickable @click="onClick()" avatar="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=813703178,1685080991&fm=11&gp=0.jpg"
			 note="您收到一条新的消息" time="2020-02-02 20:20" badge-positon="left" badge-text="99"></uni-list-chat>
			<uni-list-chat title="猫仔" clickable @click="onClick()" avatar="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=813703178,1685080991&fm=11&gp=0.jpg"
			 note="您收到一条新的消息" time="2020-02-02 20:20" badge-positon="left" badge-text="99"></uni-list-chat>
			<uni-list-chat title="猫仔" clickable @click="onClick()" avatar="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=813703178,1685080991&fm=11&gp=0.jpg"
			 note="您收到一条新的消息" time="2020-02-02 20:20" badge-positon="left" badge-text="99"></uni-list-chat>
			<uni-list-chat title="猫仔" clickable @click="onClick()" avatar="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=813703178,1685080991&fm=11&gp=0.jpg"
			 note="您收到一条新的消息" time="2020-02-02 20:20" badge-positon="left" badge-text="99"></uni-list-chat>
			<uni-list-chat title="猫仔" clickable @click="onClick()" avatar="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=813703178,1685080991&fm=11&gp=0.jpg"
			 note="您收到一条新的消息" time="2020-02-02 20:20" badge-positon="left" badge-text="99"></uni-list-chat>
			<uni-list-chat title="猫仔" clickable @click="onClick()" avatar="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=813703178,1685080991&fm=11&gp=0.jpg"
			 note="您收到一条新的消息" time="2020-02-02 20:20" badge-positon="left" badge-text="99"></uni-list-chat>
			<uni-list-chat title="猫仔" clickable @click="onClick()" avatar="https://ss1.bdstatic.com/70cFvXSh_Q1YnxGkpoWK1HF6hhy/it/u=813703178,1685080991&fm=11&gp=0.jpg"
			 note="您收到一条新的消息" time="2020-02-02 20:20" badge-positon="left" badge-text="99"></uni-list-chat>
		</uni-list>
	</view>
</template>

<style>
	.uni-list-chat,
	.uni-list.uni-border-top-bottom {
		width: 100%;
	}
</style>

<script>
	export default {
		components: {},
		computed: {
			// getCode() {
			// 	return this.$store.state.code
			// }
		},
		data() {
			return {

			}
		},
		onLoad() {

		},
		methods: {
			onClick() {
				console.log(1111)
			},
		}
	}
</script>
