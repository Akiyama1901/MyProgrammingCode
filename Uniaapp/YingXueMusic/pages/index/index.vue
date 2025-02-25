<template>
	<view class="content">
		<view class="banner">
			<swiper :indicator-dots="true" indicator-color="rgba(255,255,255,.5)" indicator-active-color="#1e90ff"
				:autoplay="true" :interval="3000" :duration="500">
				<swiper-item v-for="(item, index) in swiper" :key="index">
					<view class="item">
						<image :src="item.imageUrl" class="img" />
						<view class="tag">
							{{ item.typeTitle }}
						</view>
					</view>
				</swiper-item>
			</swiper>
		</view>
		<view class="main-bar">
			<view class="flex-item" v-for="(item, index) in contentBar" :key='index'>
				<view class="icon-wrapper">
					<image :src="item.img" class="icon"></image>
				</view>
				<p>{{ item.name }}</p>
			</view>
		</view>
<!-- 		<view class='song-list'>
			<view class="tit-bar">
				<text class="title">推荐歌单</text>
				<text class="more">歌单广场</text>
			</view>
			<scroll-view class="scroll-view" scroll-x="true">
				<view class="song-item" v-for="(item, index) in recommendSongs" :key="index">
					<image class="song-img" :src="item.picUrl"></image>
					<view class="song-desc">{{ item.name }}</view>
					<view class="count">{{ item.playCount }}</view>
				</view>
			</scroll-view>
		</view> -->
		
		<song-list title='推荐歌单' link="" :list='recommendSongs'></song-list>
		
		<view class="song-list">
			<view class="switch-line">
				<view class="flex-box">
					<view class="switch-item" :class="{ on: newType == 1 }" @click="switchTab(1)">
						新碟
					</view>
					<view class="switch-item" :class="{ on: newType == 2 }" @click="switchTab(2)">
						新歌
					</view>
					<view class="more">
						{{ newType == 1 ? '更多新碟' : '更多新歌' }}
					</view>
				</view>
			</view>
			<scroll-view class="scroll-view" scroll-x="true">
				<view class="item" v-for="(item, index) in lastestAlbums" :key="index">
					<image class="img" :src="item.picUrl"></image>
					<view class="song-desc">{{ item.name }}</view>
					<view class="song-desc c9">{{ item.artist.name }}</view>
				</view>
			</scroll-view>
		</view>
		<!-- 		精选视频 -->
		<view class="video-list song-list">
			<view class="tit-bar">
				精选视频
				<view class="more">
					更多
				</view>
			</view>
			<view class="video-item" v-for="(item, index) in relatedVideos" :key="index">
				<image :src="item.data.coverUrl"></image>
				<view class="desc">
					{{ item.data.title }}
				</view>
			</view>
		</view>
	</view>
</template>

<script>
	import {
		apiGetBanner,
		apiGetRecommendSongs,
		apiGetTopAlbum,
		apiGetRelatedVideo
	} from '@/api/index.js'
	import songList from '@/components/songList.vue';
	export default {
		components:{
			songList
		},
		data() {
			return {
				swiper: [],
				contentBar: [{
					name: '每日推荐',
					img: "/static/icon/calendar.png"
				}, {
					name: '歌单',
					img: "/static/icon/list.png"
				}, {
					name: '排行榜',
					img: "/static/icon/rank.png"
				}, {
					name: '电台',
					img: "/static/icon/radio.png"
				}, {
					name: '直播',
					img: "/static/icon/live.png"
				}],
				recommendSongs: [],
				newType: 1, //新碟新歌 1是第一个 2是第二个
				lastestAlbums: [],
				lastestTempAlbums: [], //临时变量
				relatedVideos: []
			};
		},
		onLoad() {
			this.getBanner();
			this.getRecommend();
			this.getLastestAlbum();
			this.getRelatedVideo();
		},
		methods: {
			getBanner() {
				apiGetBanner().then(res => {
					this.swiper = res.banners;
				})
			},
			getRecommend() {
				const params={
					limit:6
				}
				apiGetRecommendSongs(params).then(res => {
					// 格式化播放量
					const formatCount = data => {
						let tmp = data;
						if (data > 10000) {
							tmp = (parseInt(data / 10000) + '万')
						}
						return tmp
					}
					console.log(res);
					this.recommendSongs = res.result;
					// 格式化
					this.recommendSongs.forEach(item => {
						item.playCount = formatCount(item.playCount);
					})
				})
			},
			// 切换新碟新歌
			switchTab(type) {
				this.newType = type;
				//截取
				let temp = {
					s: type == 1 ? 0 : 3,
					e: type == 1 ? 3 : 6
				}
				this.lastestAlbums = this.lastestTempAlbums.slice(temp.s, temp.e);
			},
			// 新碟新歌
			getLastestAlbum() {
				apiGetTopAlbum().then(res => {
					this.lastestTempAlbums = res.albums;
					//取前三个作为第一类
					this.lastestAlbums = res.albums.slice(0, 3);
				})
			},
			//精选视频
			getRelatedVideo() {
				apiGetRelatedVideo().then(res => {
					console.log(res.datas);
					    this.relatedVideos = res.datas;
				})
			}
		}
	};
</script>

<style>
	.content {
		display: flex;
		justify-content: center;
		align-items: center;
		flex-direction: column;
	}

	.banner {
		width: 95%;
		height: 200rpx;
		margin-top: 30rpx;
		position: relative;
	}

	.item {
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100%;
	}

	.img {
		width: 100%;
		height: 100%;
		object-fit: cover;
		border-radius: 15rpx;
	}

	.tag {
		position: absolute;
		bottom: 5rpx;
		right: 5rpx;
		background-color: rgba(30, 144, 255, 0.5);
		color: white;
		padding: 5rpx 15rpx;
		font-size: 24rpx;
		border-radius: 10rpx;
	}

	.main-bar {
		display: flex;
		margin-top: 100rpx;
		justify-content: space-around;
		width: 100%;
		padding: 0 20rpx;
	}

	.flex-item {
		display: flex;
		flex-direction: column;
		align-items: center;
		width: 120rpx;
		height: auto;
	}

	.icon-wrapper {
		width: 90rpx;
		height: 90rpx;
		background-color: #1e90ff;
		border-radius: 50%;
		display: flex;
		justify-content: center;
		align-items: center;
		margin-bottom: 10rpx;
	}

	.icon {
		width: 45rpx;
		height: 45rpx;
		filter: brightness(0) invert(1);
	}

	.flex-item p {
		margin: 0;
		font-size: 24rpx;
		color: #333;
	}

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

	.scroll-view {
		white-space: nowrap;
		margin-top: 20rpx;
	}

	.song-item {
		display: inline-block;
		width: 200rpx;
		margin-right: 20rpx;
		position: relative;
	}

	.song-img {
		width: 200rpx;
		height: 200rpx;
		border-radius: 12rpx;
		object-fit: cover;
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
		white-space: normal;
		line-height: 1.4;
	}

	.count {
		position: absolute;
		top: 6rpx;
		right: 6rpx;
		font-size: 20rpx;
		color: #fff;
		padding: 2rpx 8rpx;
		border-radius: 10rpx;
	}

	.switch-line {
		padding: 20rpx;
		margin-bottom: 10rpx;
	}

	.flex-box {
		display: flex;
		align-items: center;
	}

	.switch-item {
		font-size: 28rpx;
		color: #999;
		margin-right: 30rpx;
		position: relative;
	}

	.switch-item.on {
		color: #333;
		font-weight: bold;
		font-size: 34rpx;
	}

	.more {
		font-size: 24rpx;
		color: #999;
		margin-left: auto;
	}

	.scroll-view .item {
		display: inline-block;
		width: 220rpx;
		margin-right: 20rpx;
	}

	.scroll-view .img {
		width: 220rpx;
		height: 220rpx;
		border-radius: 8rpx;
	}

	.scroll-view .song-desc {
		font-size: 26rpx;
		color: #333;
		margin-top: 8rpx;
		overflow: hidden;
		text-overflow: ellipsis;
		white-space: nowrap;
		line-height: 1.2;
	}

	.scroll-view .c9 {
		color: #999;
		font-size: 24rpx;
		margin-top: 4rpx;
	}

	.video-list {
		margin-top: 20rpx;
	}

	.video-list .tit-bar {
		padding: 10rpx 0;
	}

	.video-list .video-item {
		position: relative;
		margin-bottom: 30rpx;
	}

	.video-list image {
		width: 100%;
		height: 360rpx;
		border-radius: 12rpx;
		object-fit: cover;
	}

	.video-list .desc {
		font-size: 28rpx;
		color: #333;
		margin-top: 16rpx;
		line-height: 1.4;
		overflow: hidden;
		text-overflow: ellipsis;
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
	}

	.video-list .tit-bar {
		display: flex;
		justify-content: space-between;
		align-items: center;
		margin-bottom: 20rpx;
	}

	.video-list .tit-bar {
		font-size: 34rpx;
		font-weight: bold;
		color: #333;
	}

	.video-list .more {
		font-size: 24rpx;
		color: #999;
		margin-left: auto;
	}
</style>