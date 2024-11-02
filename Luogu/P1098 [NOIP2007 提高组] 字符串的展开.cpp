#include <bits/stdc++.h>
using namespace std;
int p1,p2,p3;
vector<char> ans;
string s;
int main()
{
    cin >> p1 >> p2 >> p3 >> s;
    for(int i=0;i<s.size();i++)
    {
        if(s[i]!='-') ans.push_back(s[i]);
        else if((i==0 || i==s.size()-1) && s[i]=='-' ) ans.push_back('-');
        else if(s[i]=='-' && (s[i-1]=='-' || s[i+1]=='-')) ans.push_back('-');
        else if(s[i]=='-')
        {
            if(s[i-1]>=s[i+1] || (s[i-1]<58 && s[i+1]>96)) ans.push_back('-');
            else if(s[i+1]==s[i-1]+1) continue;
            else
            {
                if(p1==3)
                {
                    for(int k=1;k<=(s[i+1]-s[i-1]-1)*p2;k++) ans.push_back('*');
                }
                else if(s[i+1]<=57 && s[i+1]>=48 && s[i-1]<=57 && s[i-1]>=48)
                {
                    if(p3==1)
                    {
                        for(int k=s[i-1]+1;k<=s[i+1]-1;k++)
                            for(int j=1;j<=p2;j++)
                                ans.push_back(char(k));
                    }
                    else if(p3==2)
                    {
                        for(int k=s[i+1]-1;k>=s[i-1]+1;k--)
                            for(int j=1;j<=p2;j++)
                                ans.push_back(char(k));                        
                    }
                }
                else if(s[i+1]<=122 && s[i+1]>=97 && s[i-1]<=122 && s[i-1]>=97)
                {
                    if(p1==1)
                    {
                        if(p3==1)
                        {
                            for(int k=s[i-1]+1;k<=s[i+1]-1;k++)
                                for(int j=1;j<=p2;j++)
                                    ans.push_back(char(k));                            
                        }
                        else if(p3==2)
                        {
                            for(int k=s[i+1]-1;k>=s[i-1]+1;k--)
                                for(int j=1;j<=p2;j++)
                                    ans.push_back(char(k));                                
                        }
                    }
                    else if(p1==2)
                    {
                        if(p3==1)
                        {
                            for(int k=s[i-1]+1;k<=s[i+1]-1;k++)
                                for(int j=1;j<=p2;j++)
                                    ans.push_back(char(k-32));                                
                        }
                        else if(p3==2)
                        {
                            for(int k=s[i+1]-1;k>=s[i-1]+1;k--)
                                for(int j=1;j<=p2;j++)
                                    ans.push_back(char(k-32));                                
                        }
                    }
                }
            }
        }
    }
    for(int i=0;i<ans.size();i++) cout << ans[i];
    return 0;
}
