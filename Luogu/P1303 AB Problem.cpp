#include <bits/stdc++.h>
using namespace std;
const int N = 10000;

struct bigNumber {
    int len, x[N];
    bigNumber() {
        memset(x, 0, sizeof(x));
        len = 1;
    }
    void print() {
        for(int i = len; i > 0; i--) 
            printf("%d", x[i]);
        puts("");
    }   
};

bigNumber fix(bigNumber a) {
    for(int i = 1; i < a.len; i++) {
        a.x[i+1] += a.x[i] / 10;
        a.x[i] %= 10;
    }
    while(a.x[a.len] >= 10) {
        a.x[a.len+1] += a.x[a.len] / 10;
        a.x[a.len] %= 10;
        a.len++;
    }
    while(!a.x[a.len]&&a.len>1) a.len--; //前导0 
    return a;
}

inline bigNumber operator *(bigNumber a, bigNumber b) {
    bigNumber c;
    c.len = a.len + b.len - 1;
    for(int i = 1; i <= a.len; ++i)
        for(int j = 1; j <= b.len; ++j)
            c.x[i+j-1] += a.x[i] * b.x[j];
    return fix(c);
}

int main() {
    char s[N];
    scanf("%s", s);
    int len1 = strlen(s);
    bigNumber a;
    for(int i = 0; i < len1; i++)
        a.x[len1 - i] = s[i] - '0';
    a.len = len1;
        
    scanf("%s", s);
    int len2 = strlen(s);
    bigNumber b;
    for(int i = 0; i < len2; i++)
        b.x[len2 - i] = s[i] - '0';
    b.len = len2;
        
    bigNumber result = a * b;
    result.print();

    return 0;
}
