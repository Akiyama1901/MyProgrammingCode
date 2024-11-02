#include<bits/stdc++.h>
using namespace std;

int P;
long long a[510];

long long powerOf2(int a)
{
    long long res=1;
    for(int i=1;i<=a;i++)
    {
        res*=2;
    }
    return res;
}

int main()
{
    cin>>P;
    cout<<ceil(P*log10(2))<<endl;
    long long tmp=powerOf2(32);
    a[500]=1;
    int t32=P/32;
    int t1=P-t32*32;
    for(int T=1;T<=t32;T++)
    {
        for(int i=500;i>=1;i--)
        {
            a[i]*=tmp;
        }
        for(int i=500;i>=1;i--)
        {
            a[i-1]+=a[i]/10;
            a[i]%=10;
        }
    }
    for(int T=1;T<=t1;T++)
    {
        for(int i=500;i>=1;i--)
        {
            a[i]*=2;
        }
        for(int i=500;i>=1;i--)
        {
            a[i-1]+=a[i]/10;
            a[i]%=10;
        }
    }
    a[500]--;
    for(int i=1;i<=500;i++)
    {
        cout<<a[i];
        if(i%50==0) cout<<endl;
    }
    return 0;
}
