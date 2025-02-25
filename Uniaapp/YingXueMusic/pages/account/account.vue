<template>
	<view class="account">
		<uni-nav-bar left-icon="scan" right-icon="bars" title="账号" height="100rpx" />
		<scroll-view scroll-y="true" class="page-content">
			<!-- 未登录 -->
			<view v-if="!userInfo.hasLogin" class="empty-user">
				<view class="login-tip">
					尽享海量音乐
				</view>
				<navigator class="login-btn" url="">
					立即登录
				</navigator>
			</view>
			<template v-if="userInfo.hasLogin">
				<!-- 登录后的用户信息 -->
			</template>

			<!-- 功能列表 -->
			<view class="mall-bar">
				<view class="flex-item">
					<image src="/static/account/1.png" mode="widthFix" class="icon"></image>
					<text>消息</text>
				</view>
				<view class="flex-item">
					<image src="/static/account/2.png" mode="widthFix" class="icon"></image>
					<text>商城</text>
					<view class="txt">29元起</view>
				</view>
				<view class="flex-item">
					<image src="/static/account/3.png" mode="widthFix" class="icon"></image>
					<text>演出</text>
					<view class="txt">小巨蛋</view>
				</view>
				<view class="flex-item">
					<image src="/static/account/4.png" mode="widthFix" class="icon"></image>
					<text>个性</text>
				</view>
			</view>

			<!-- 设置列表 -->
			<uni-list>
				<uni-list-item title="口袋彩铃" thumb="/static/account/5.png" size="mini"></uni-list-item>
				<uni-list-item title="我的订单" thumb="/static/account/6.png" size="mini"></uni-list-item>
				<uni-list-item title="创造者中心" thumb="/static/account/7.png" size="mini"></uni-list-item>
				<uni-list-item title="设置" thumb="/static/account/8.png" size="mini"></uni-list-item>
				<uni-list-item title="夜间模式" thumb="/static/account/9.png" size="mini" :showSwitch="true"
					@switchChange="switchChange"></uni-list-item>
				<uni-list-item title="定时开关" thumb="/static/account/10.png" size="mini"></uni-list-item>
				<uni-list-item title="音乐闹钟" thumb="/static/account/11.png" size="mini"></uni-list-item>
				<uni-list-item title="在线听歌" thumb="/static/account/12.png" size="mini"></uni-list-item>
				<uni-list-item title="优惠" thumb="/static/account/13.png" size="mini"></uni-list-item>
				<uni-list-item title="分享音乐" thumb="/static/account/14.png" size="mini"></uni-list-item>
				<uni-list-item title="关于" thumb="/static/account/15.png" size="mini"></uni-list-item>
			</uni-list>

			<view class="logout" v-if="userInfo.hasLogin">
				退出登录
			</view>
		</scroll-view>
	</view>
</template>

<script>
import {
	mapState
} from "vuex"
import uniNavBar from "../../uni_modules/uni-nav-bar/components/uni-nav-bar/uni-nav-bar.vue"
import uniList from "@/uni_modules/uni-list/components/uni-list/uni-list.vue"
import uniListItem from "@/uni_modules/uni-list/components/uni-list-item/uni-list-item.vue"
export default {
	components: {
		uniList,
		uniListItem,
		uniNavBar
	},
	computed: {
		...mapState(['hasLogin', 'userInfo'])
	},
	data() {
		return {

		}
	},
	methods: {
		switchChange(e) {
			console.log(e);
			uni.showToast({
				title: "value:" + e.value
			})
		}
	}
}
</script>

<style>
.account {
	background: #f5f5f5;
	min-height: 100vh;
}

.empty-user {
	background: #fff;
	padding: 40rpx 30rpx;
	text-align: center;
}

.login-tip {
	font-size: 32rpx;
	color: #333;
	margin-bottom: 20rpx;
}

.login-btn {
	display: inline-block;
	padding: 12rpx 40rpx;
	background: #1e90ff;
	color: #fff;
	border-radius: 30rpx;
	font-size: 28rpx;
}

.mall-bar {
	display: flex;
	background: #fff;
	padding: 30rpx 20rpx;
	margin-top: 20rpx;
}

.flex-item {
	flex: 1;
	display: flex;
	flex-direction: column;
	align-items: center;
	position: relative;
}

.icon {
	width: 50rpx;
	height: 50rpx;
	margin-bottom: 10rpx;
}

.txt {
	font-size: 12rpx;
	color: #999;
	background: #f5f5f5;
	padding: 2rpx 8rpx;
	border-radius: 20rpx;
	text-align: center;
	position: absolute;
	bottom: -25rpx;
}

.logout {
	margin: 40rpx 20rpx;
	text-align: center;
	padding: 20rpx 0;
	background: #fff;
	color: #666;
	border-radius: 8rpx;
	font-size: 28rpx;
}
</style>