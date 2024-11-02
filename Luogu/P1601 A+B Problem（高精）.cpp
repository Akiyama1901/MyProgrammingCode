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
} a, b;

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
    return a;
}

inline bigNumber operator +(bigNumber a, bigNumber b) {
    bigNumber c;
    c.len = max(a.len, b.len);
    for(int i = 1; i <= c.len; ++i)
        c.x[i] = a.x[i] + b.x[i];
    return fix(c);
}

int main() {
    char s[N];
    int a[N], b[N];
    scanf("%s", s);
    int len1 = strlen(s);
    for(int i = 0; i < len1; i++)
        a[i] = s[len1 - i - 1] - '0';
        
    scanf("%s", s);
    int len2 = strlen(s);
    for(int i = 0; i < len2; i++)
        b[i] = s[len2 - i - 1] - '0';
        
    bigNumber result;
    result.len = max(len1, len2);
    for(int i = 0; i < result.len; i++)
        result.x[i+1] = a[i] + b[i];
        
    result = fix(result);
    result.print();

    return 0;
}
