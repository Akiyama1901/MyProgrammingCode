#include <bits/stdc++.h>
using namespace std;
int c[100000];
int main()
{
  int t,n,a;
  cin>>t;
  for(int i=0; i<t; i++)
  {
    cin>>n>>a;
    memset(c,0,sizeof(c));
    c[0]=1;
    int l=1;
    for(int j=2; j<=n; j++)//开始阶乘计算
    {
      int w=0;
      for(int k=0; k<l; k++)//高精度乘单精度
      {
        c[k]=c[k]*j+w;
        w=c[k]/10;
        c[k]%=10;
      }
      while(w>0)//处理多进位
      {
        c[l]=w%10;
        l++;
        w/=10;
      }
    }
    int sum=0;
    for(int j=0; j<l; j++)
      if(c[j]==a) sum++;//统计个数
    cout<<sum<<endl;
  }
  return 0;
}
