<template>
	<view class='song-list'>
		<view class="tit-bar">
			<text class="title">{{ title }}</text>
			<navigator :url="link" class="more">歌单广场</navigator>
		</view>
		<view class="song-list-content">
			<view class="song-item" v-for="(item, index) in list" :key="index">
				<view class="img-wrapper">
					<image class="song-img" :src="item.picUrl" mode="aspectFill"></image>
					<view class="count">{{ item.playCount }}</view>
				</view>
				<view class="song-desc">{{ item.name }}</view>
			</view>
		</view>
	</view>
</template>

<script>
export default {
	props: {
		title: {
			type: String,
			default: ''
		},
		link: {
			type: String,
			default: ''
		},
		list: {
			type: Array,
			default: []
		}
	}
}
</script>

<style>
.song-list {
	width: 100%;
	padding: 20rpx;
	box-sizing: border-box;
}

.tit-bar {
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 20rpx 0;
}

.title {
	font-size: 34rpx;
	font-weight: bold;
	color: #333;
}

.more {
	font-size: 26rpx;
	color: #666;
	background: #f5f5f5;
	padding: 4rpx 16rpx;
	border-radius: 30rpx;
}

.song-list-content {
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	margin-top: 20rpx;
}

.song-item {
	width: 32%;
	margin-bottom: 20rpx;
}

.img-wrapper {
	position: relative;
	width: 100%;
	padding-bottom: 100%;
}

.song-img {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	border-radius: 12rpx;
	object-fit: cover;
}

.count {
	position: absolute;
	top: 6rpx;
	right: 6rpx;
	font-size: 20rpx;
	color: #fff;
	background: rgba(0, 0, 0, 0.4);
	padding: 2rpx 8rpx;
	border-radius: 10rpx;
}

.song-desc {
	font-size: 26rpx;
	color: #333;
	margin-top: 10rpx;
	overflow: hidden;
	text-overflow: ellipsis;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
	line-height: 1.4;
}
</style>