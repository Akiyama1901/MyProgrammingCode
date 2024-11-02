#include<bits/stdc++.h>
using namespace std;
int x[4]={-1,0,1,0};//创建移动的方向数组 
int y[4]={0,1,0,-1};
int main()
{
	char dt[15][15];
	int xx1,yy1,xx2,yy2;
	for(int i=1;i<=10;i++)
	{
		for(int j=1;j<=10;j++)
		{
			cin>>dt[i][j];//将字符输入到二维数组中 
			if(dt[i][j]=='F')
			{
				xx1=i;
				yy1=j;
			}//保存农民的初始位置 
			if(dt[i][j]=='C')
			{
				xx2=i;
				yy2=j;
			}//保存牛的初始位置 
		}
	}
	int sum=0,temp1=0,temp2=0;//初始化计时器sum,temp为方向数组中的移动书签
	int X1,X2,Y1,Y2;//表示下一步的位置坐标 
	while(1)
	{
		X1=xx1+x[temp1];//更新农民下一步的行号坐标 
		Y1=yy1+y[temp1];//更新农民下一步的列号坐标 
		if(dt[X1][Y1]=='*'||X1<1||X1>10||Y1<1||Y1>10)//如果下一步是障碍物并且越界
		{
			temp1++;//方向数组书签加1，代表顺时针旋转 
			if(temp1==4)//如果超出则回到0的位置，形成环状 
			temp1=0;
		}
		else
		{
			xx1=X1;//农民开始移动 
			yy1=Y1;
		}
		X2=xx2+x[temp2];//更新牛下一步的行号坐标 
		Y2=yy2+y[temp2];//更新牛下一步的列号坐标 
		if(dt[X2][Y2]=='*'||X2<1||X2>10||Y2<1||Y2>10)//如果下一步不是障碍物并且没有越界
		{
			temp2++;
			if(temp2==4)
			temp2=0;
		}
		else
		{
			xx2=X2;//牛开始移动 
			yy2=Y2;
		}
		sum++;//计时器增加1
		if(xx1==xx2&&yy1==yy2)//如果他俩在同一个格子内 
		{
			cout<<sum;
			return 0;
		}
		if(sum>=100000000)
		{
			cout<<0;
			return 0;
		}
	} 
	return 0;
}
