#include<bits/stdc++.h>
using namespace std;
int m , n , maxn;
int arr[405];
struct node{
	int id;//当前工件的当前工序在哪个机器上操作
	int cost;//当前工件的当前工序需要花费时间 
}a[21][21];
int mactime[21][1000000];
int step[21];
int lasttime[21];
int main(){
	scanf("%d %d" , &m , &n);
	for(int i = 1 ; i <= n * m ; i++) cin >> arr[i];
	for(int i = 1 ; i <= n ; i++){
		for(int j = 1 ; j <= m ; j++) scanf("%d" , &a[i][j].id);
	}
	for(int i = 1 ; i <= n ; i++){
		for(int j = 1 ; j <= m ; j++) scanf("%d" , &a[i][j].cost);
	}
	for(int i = 1 ; i <= n * m ; i++){
		int temp = arr[i];//需要进行操作的工件 
		step[temp]++;//第temp个工件的执行工序加一
		int ids = a[temp][step[temp]].id;
		int costs = a[temp][step[temp]].cost;
		int ans = 0 , k;
		for(k = lasttime[temp] + 1 ; ; k++){
			if(!mactime[ids][k]) ans++;
			else ans = 0;
			if(ans == costs){
				for(int j = k - ans + 1 ; j <= k ; j++) mactime[ids][j] = 1;
				break;
			}
		} 
		lasttime[temp] = k;
		maxn = max(k , maxn); 
	}
	cout << maxn;
	return 0;
}
