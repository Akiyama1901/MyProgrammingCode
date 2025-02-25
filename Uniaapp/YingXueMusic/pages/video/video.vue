<template>
  <view class="video">
    <!-- 视频列表 -->
    <view class="video-list" v-if="relatedVideo.length > 0">
      <view class="video-item" v-for="(item, index) in relatedVideo" :key="index">
        <view class="video-wrap">
          <view class="cover-wrap">
            <image :src="item.coverUrl" class="img"></image>
            <view class="play-count">
              <text class="iconfont icon-play"></text>
              {{ formatCount(item.playTime) }}
            </view>
          </view>
          <view class="content">
            <view class="desc">{{ item.title }}</view>
            <view class="creator">
              <text class="name">{{ item.creator.nickname }}</text>
            </view>
          </view>
        </view>
      </view>
    </view>
    <view v-else>暂无视频</view>
  </view>
</template>

<script>
import { apiGetAllVideos } from '@/api/index.js'

export default {
  data() {
    return {
      relatedVideo: []
    }
  },
  onLoad() {
    this.getList();
  },
  methods: {
    getList() {
      const params = {
        area: 'all',
        type: '全部',
        limit: 100,
        offset: 0,
      };
      apiGetAllVideos(params).then(res => {
        console.log(res);
        this.relatedVideo = this.filterVideosByRegion(res.datas);
      }).catch(error => {
        console.error("Error fetching videos:", error);
      });
    },
    filterVideosByRegion(videos) {
      return videos.map(item => ({
        coverUrl: item.data.coverUrl,
        title: item.data.title,
        creator: item.data.creator,
        playTime: item.data.playTime,
        vid: item.data.vid,
      }));
    },
    formatCount(count) {
      if (count > 10000) {
        return (count / 10000).toFixed(1) + '万'
      }
      return count
    }
  }
}
</script>

<style>
.video-list {
  padding: 20rpx;
  margin-top: 0;
}

.video-item {
  margin-bottom: 40rpx;
}

.video-wrap {
  background-color: #fff;
  border-radius: 16rpx;
  overflow: hidden;
  box-shadow: 0 2rpx 10rpx rgba(0, 0, 0, 0.05);
}

.cover-wrap {
  position: relative;
  width: 100%;
}

.img {
  width: 100%;
  height: 360rpx;
  object-fit: cover;
  border-radius: 16rpx 16rpx 0 0;
}

.play-count {
  position: absolute;
  top: 16rpx;
  right: 16rpx;
  background: rgba(0, 0, 0, 0.6);
  color: #fff;
  font-size: 22rpx;
  padding: 6rpx 16rpx;
  border-radius: 30rpx;
  display: flex;
  align-items: center;
  gap: 4rpx;
}

.play-count .iconfont {
  font-size: 22rpx;
}

.content {
  padding: 24rpx 20rpx;
}

.desc {
  font-size: 28rpx;
  color: #333;
  line-height: 1.5;
  margin-bottom: 20rpx;
  display: -webkit-box;
  -webkit-box-orient: vertical;
  -webkit-line-clamp: 2;
  overflow: hidden;
  font-weight: 500;
}

.creator {
  display: flex;
  align-items: center;
}

.name {
  font-size: 24rpx;
  color: #666;
  background: #f7f7f7;
  padding: 6rpx 16rpx;
  border-radius: 30rpx;
  display: flex;
  align-items: center;
}

.video {
  background: #f9f9f9;
  min-height: 100vh;
  padding-bottom: 20rpx;
}
</style>
