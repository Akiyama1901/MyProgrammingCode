<template>
	<view>
		<uni-nav-bar height="100rpx">
			<block v-slot:left>
				<image src="@/static/village/v_left.png" mode="" class="top-img left"></image>
			</block>
			<view class="top-tab">
				<view class="tab-item" :class="{ active: currentId === item.id }" v-for="(item, index) in navList"
					:key="index" @click="switchTab(item.id)">
					{{ item.name }}
				</view>
			</view>
			<block v-slot:right>
				<image src="@/static/village/v_right.png" mode="" class="top-img right"></image>
			</block>
		</uni-nav-bar>
		<view class="page-content">
			<mescroll-uni :fixed="false" :down="downOption" :up="upOption" @down="downCallback" @up="upCallback">
				<view class="hot-comment">
					<view class="hot-title">
						云村热评墙 <uni-icons type="right" size="30"></uni-icons>
						<swiper class="comment-swiper" :autoplay="true" :duration="500" :circular="true"
							:vertical="true">
							<swiper-item v-for="(item, index) in msgList" :key="index">
								<text class="sub-title">{{ item.name }}</text>
							</swiper-item>
						</swiper>
					</view>
					<view class="date">
						<text>{{ curDate[1] }}</text>
						<text class="day">{{ curDate[2] }}</text>
					</view>
				</view>
				<view class="list-content">
					<view class="post-list" v-if="currentId === 0">
						<view class="post-item" v-for="(item, index) in splitList.list1" :key="index">
							<image :src="item.cover" mode="aspectFill" class="post-img"></image>
							<view class="post-content">
								<view class="post-title">{{ item.name }}</view>
								<view class="post-author">{{ item.artists[0].name }}</view>
							</view>
						</view>
					</view>
					<view class="post-list" v-else>
						<view class="post-item" v-for="(item, index) in splitList.list2" :key="index">
							<image :src="item.cover" mode="aspectFill" class="post-img"></image>
							<view class="post-content">
								<view class="post-title">{{ item.name }}</view>
								<view class="post-author">{{ item.artists[0].name }}</view>
							</view>
						</view>
					</view>
				</view>
				<view class="no-more" v-if="isNoMore">到底啦~</view>
			</mescroll-uni>
		</view>
	</view>
</template>

<script>
import {
	apiGetRecommendSongs,
	apiGetAllMV
} from "@/api/index.js"
import uniNavBar from "@/uni_modules/uni-nav-bar/components/uni-nav-bar/uni-nav-bar.vue"
import Mescroll from "@/uni_modules/mescroll-uni/components/mescroll-uni/mescroll-uni.vue"
export default {
	components: {
		uniNavBar,
		Mescroll
	},
	data() {
		return {
			navList: [{
				name: '广场',
				id: 0
			},
			{
				name: '动态',
				id: 1
			}
			],
			currentId: 0,
			downOption: {
				auto: false,
				page: {
					num: 0,
					size: 10
				}
			},
			upOption: {
				auto: false,
				page: {
					num: 0,
					size: 10
				},
				textNoMore: ''
			},
			msgList: [{
				name: "如果不上钻石，那真是无敌了啊哈哈",
				id: ""
			},
			{
				name: "看这个二创，还不如去看喜羊羊与灰太狼呢",
				id: ""
			},
			{
				name: "强者就是要羞辱弱者",
				id: ""
			},
			{
				name: "这下添砖加瓦，配送到家了",
				id: ""
			},
			{
				name: "老师给我高分吧，我给你评教100分",
				id: ""
			},
			],
			curDate: String(new Date()).split(" "),
			allList: [],
			splitList: {
				list1: [],
				list2: []
			},
			isNoMore: false
		}
	},
	onLoad() {
		this.switchTab(0)
	},
	methods: {
		switchTab(id) {
			this.currentId = id;
			if (id === 0) {
				this.getList(1, 5, 'list1');
			} else {
				this.getList(1, 5, 'list2');
			}
		},
		getList(pageNum, pageSize, listType, sucessCallback, errCallback) {
			const params = {
				id: this.currentId,
				pageNum,
				pageSize
			}
			apiGetAllMV(params).then(res => {
				if (res.data) {
					const allData = res.data;
					const halfLength = Math.floor(allData.length / 2);

					this.splitList.list1 = allData.slice(0, halfLength);
					this.splitList.list2 = allData.slice(halfLength);

					const currentData = this.currentId === 0 ? this.splitList.list1 : this.splitList.list2;
					sucessCallback && sucessCallback(currentData);
				}
			}).catch(err => {
				console.error('获取视频列表失败:', err);
				errCallback && errCallback(err);
			});
		},
		upCallback(mescroll) {
			this.isNoMore = true;
			mescroll.endSuccess(0, false);
		},
		downCallback(mescroll) {
			this.getList(mescroll.num, mescroll.size, this.currentId === 0 ? 'list1' : 'list2', res => {
				mescroll.endSuccess();
			}, () => {
				mescroll.endErr();
			})
		}
	}
}
</script>

<style>
.top-img {
	width: 50rpx;
	height: 50rpx;
}

.left {
	margin-left: 20rpx;
}

.right {
	margin-right: 20rpx;
}

.top-tab {
	display: flex;
	justify-content: center;
	align-items: center;
	height: 88rpx;
	width: 300rpx;
	margin: 0 auto;
}

.tab-item {
	position: relative;
	padding: 0 30rpx;
	font-size: 28rpx;
	color: #666;
	height: 88rpx;
	line-height: 88rpx;
	transition: all 0.3s;
	flex: 1;
	text-align: center;
}

.tab-item.active {
	color: #1e90ff;
	font-size: 32rpx;
	font-weight: bold;
}

.tab-item.active::after {
	content: '';
	position: absolute;
	bottom: 0;
	left: 30rpx;
	right: 30rpx;
	height: 4rpx;
	background: #1e90ff;
	border-radius: 2rpx;
}

.page-content {
	padding: 20rpx;
}

.hot-comment {
	background: #333;
	color: #fff;
	padding: 30rpx;
	border-radius: 16rpx;
	display: flex;
	justify-content: space-between;
	align-items: flex-start;
	margin-bottom: 20rpx;
}

.hot-title {
	font-size: 32rpx;
	font-weight: bold;
	flex: 1;
}

.comment-swiper {
	height: 40rpx;
	margin-top: 10rpx;
}

.sub-title {
	display: block;
	font-size: 26rpx;
	color: #999;
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

.date {
	text-align: right;
	font-size: 24rpx;
	margin-left: 20rpx;
}

.day {
	display: block;
	font-size: 40rpx;
	font-weight: bold;
	margin-top: 4rpx;
}

.post-list {
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
}

.post-item {
	width: 48%;
	margin-bottom: 20rpx;
	background: #fff;
	border-radius: 12rpx;
	overflow: hidden;
}

.post-img {
	width: 100%;
	height: 200rpx;
	object-fit: cover;
}

.post-content {
	padding: 16rpx;
}

.post-title {
	font-size: 28rpx;
	color: #333;
	line-height: 1.4;
	margin-bottom: 8rpx;
	overflow: hidden;
	text-overflow: ellipsis;
	display: -webkit-box;
	-webkit-line-clamp: 2;
	-webkit-box-orient: vertical;
}

.post-author {
	font-size: 24rpx;
	color: #999;
}

.no-more {
	text-align: center;
	color: #999;
	font-size: 24rpx;
	padding: 20rpx 0;
}
</style>