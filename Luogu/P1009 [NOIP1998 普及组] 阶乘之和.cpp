#include<bits/stdc++.h>
using namespace std;
const int N = 10000;
int n;

struct bigNumber
{
    int len, x[N];
    bigNumber()
    {
        memset(x, 0, sizeof(x));
        len = 1;
    }
    void print()
    {
        for(int i = len; i > 0; i--) 
            printf("%d", x[i]);
        puts("");
    }   
} a, b;

bigNumber fix(bigNumber a)
{
    for(int i = 1; i < a.len; i++)
    {
        a.x[i+1] += a.x[i] / 10;
        a.x[i] %= 10;
    }
    while(a.x[a.len] >= 10)
    {
        a.x[a.len+1] += a.x[a.len] / 10;
        a.x[a.len] %= 10;
        a.len++;
    }
    return a;
}

inline bigNumber operator +(bigNumber a, bigNumber b)
{
    bigNumber c;
    c.len = max(a.len, b.len);
    for(int i = 1; i <= c.len; ++i)
        c.x[i] = a.x[i] + b.x[i];
    return fix(c);
}

inline bigNumber operator *(bigNumber a, int b)
{
    for(int i = 1; i <= a.len; i++) 
        a.x[i] *= b;
    return fix(a);
}


int main() 
{
    scanf("%d",&n);
    a.x[1] = 1;
    b.x[1] = 0;
    for(int i = 1; i <= n ; ++i)
    {
        a=a*i;
        b=b+a;
    }
	b.print();
    return 0;
}
