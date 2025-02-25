<template>
	<view class="mine">
		<scroll-view class="nav-list" scroll-x="true">
			<view class="item" v-for="(item, index) in navList" :key="index">
				<image class="img" :src="'/static/mine/' + item.imd + '.png'"></image>
				<view class="desc">
					{{ item.name }}
				</view>
			</view>
		</scroll-view>
		<uni-list>
			<uni-list-item title="本地音乐" thumb="/static/mine/m_1.png"></uni-list-item>
			<uni-list-item title="最近播放" thumb="/static/mine/m_2.png"></uni-list-item>
			<uni-list-item title="我的电台" thumb="/static/mine/m_3.png"></uni-list-item>
			<uni-list-item title="我的收藏" thumb="/static/mine/m_4.png"></uni-list-item>
		</uni-list>
		<song-list title='推荐歌单' link="" :list='recommendSongs'></song-list>
	</view>
</template>

<script>
	import uniList from "@/uni_modules/uni-list/components/uni-list/uni-list.vue"
	import uniListItem from "@/uni_modules/uni-list/components/uni-list-item/uni-list-item.vue"
	import songList from '@/components/songList.vue';
	import {apiGetRecommendSongs} from '@/api/index.js'
	export default {
		components: {
			uniList,
			uniListItem,
			songList
		},
		data() {
			return {
				navList: [{
						name: '私人FM',
						imd: 1
					},
					{
						name: '最嗨电音',
						imd: 2
					},
					{
						name: 'ACG专区',
						imd: 3
					},
					{
						name: 'Sati空间',
						imd: 4
					},
					{
						name: '私藏推荐',
						imd: 5
					},
					{
						name: '因乐交友',
						imd: 6
					},
					{
						name: '亲子频道',
						imd: 7
					},
					{
						name: '古典专区',
						imd: 8
					}
				],
				recommendSongs: []
			}
		},
		onLoad(){
			this.getRecommend();
		},
		methods: {
			getRecommend() {
				const params = {
					limit: 6
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
			}
		}
	}
</script>

<style>
	.mine {
		padding: 40rpx 20rpx 20rpx;
		background: #f9f9f9;
		min-height: 100vh;
	}

	.nav-list {
		white-space: nowrap;
		padding: 10rpx 0;
		width: 100%;
		margin-top: 30rpx;
	}

	.item {
		display: inline-block;
		width: 140rpx;
		text-align: center;
		margin-right: 20rpx;
	}

	.img {
		width: 70rpx;
		height: 70rpx;
		padding: 16rpx;
		background-color: #1e90ff;
		border-radius: 50%;
		margin-bottom: 10rpx;
	}

	.desc {
		font-size: 24rpx;
		color: #333;
		white-space: nowrap;
		overflow: hidden;
		text-overflow: ellipsis;
		padding: 0 10rpx;
	}

	/* 隐藏滚动条但保持可以滚动 */
	::-webkit-scrollbar {
		display: none;
		width: 0;
		height: 0;
		color: transparent;
	}
</style>