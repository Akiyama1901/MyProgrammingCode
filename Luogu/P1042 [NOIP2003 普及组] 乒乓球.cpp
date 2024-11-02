#include<bits/stdc++.h>
using namespace std;
 
char str[1000000005];
int cnt=0;
 
void game(int n)
{
 
    int a=0,b=0;
    for(int i=0;i<cnt;i++){
        if(str[i]=='W') a++;
        if(str[i]=='L') b++;
 
        if((a>=n||b>=n)&&abs(a-b)>=2){
            cout<<a<<":"<<b<<endl;
            a=b=0;
        }
    }
    cout<<a<<":"<<b<<endl;
}
 
int main(){
    char ch;
 
    while(cin>>ch&&ch!='E'){
        if(ch=='W'||ch=='L'){
          str[cnt++]=ch;
        }
    }
 
    game(11);
    cout<<endl;
    game(21);
    return 0;
}
