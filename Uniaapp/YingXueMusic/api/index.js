import request from "@/utils/request";

// 轮播图
export function apiGetBanner(data) {
	return request.request({
		url: '/banner',
		method: 'GET',
		data
	});
}

// 推荐歌单
export function apiGetRecommendSongs(data) {
	return request.request({
		url: '/personalized',
		method: 'GET',
		data
	});
}

// 新碟新歌
export function apiGetTopAlbum(data) {
	return request.request({
		url: '/album/newest',
		method: 'GET',
		data
	});
}

//推荐视频
export function apiGetRelatedVideo(data) {
	return request.request({
		url: '/video/timeline/recommend',
		method: 'GET',
		data
	});
}

//视频
export function apiGetNavList(data) {
	return request.request({
		url: '/video/category/list',
		method: 'GET',
		data
	});
}

export function apiGetAllVideos(data) {
	return request.request({
		url: '/video/timeline/all',
		method: 'GET',
		data
	});
}

export function apiGetAllMV(data) {
	return request.request({
		url: '/mv/all?limit=100',
		method: 'GET',
		data
	});
}