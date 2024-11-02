#include <bits/stdc++.h>

using namespace std;
/*
 1.所有信息输入后排序，排序方式如下：
（1）先按帮贡排序；
（2）如帮贡一样，则按输入顺序排列。

2.再重新编好职位后排输出顺序，也就是职位内的排名，排序方式如下：
（1）先按现在的职位排序；
（2）如职位相同，再按等级排序；
（3）如果恰好等级还破天荒地一样，则按输入顺序排列。
 */
const int N = 120;
int n;
struct Person {
    string Name, ZhiWei, NewZhiWei;//姓名，职位，修改后职位
    long long GongXian;//帮贡
    int DengJi, Order;//等级，序号
} Persons[N];

int change(string a) {
    if (a == "BangZhu") return 0;
    if (a == "FuBangZhu") return 1;
    if (a == "HuFa") return 2;
    if (a == "ZhangLao") return 3;
    if (a == "TangZhu") return 4;
    if (a == "JingYing") return 5;
    if (a == "BangZhong") return 6;
}

//第一轮排序规则
// 按贡献排，如果贡献一样的话，那么按输入的顺序排
int cmp1(Person x, Person y) {
    if (x.GongXian == y.GongXian) return x.Order < y.Order;
    return x.GongXian > y.GongXian;
}

//（1）先按现在的职位排序；
//（2）如职位相同，再按等级排序；
//（3）如果恰好等级还破天荒地一样，则按输入顺序排列。
int cmp2(Person x, Person y) {
    if (change(x.NewZhiWei) == change(y.NewZhiWei)) {
        if (x.DengJi == y.DengJi) return x.Order < y.Order;
        return x.DengJi > y.DengJi;
    }
    return change(x.NewZhiWei) < change(y.NewZhiWei);
}

int main() {
    cin >> n;
    //输入
    for (int i = 1; i <= n; i++) {
        cin >> Persons[i].Name >> Persons[i].ZhiWei >> Persons[i].GongXian >> Persons[i].DengJi;
        Persons[i].Order = i;
    }
    //因为有一位帮主，两位副帮主，所以，前三名已经被占领，不需要排，只需要把第4位开始的进行排即可。
    sort(Persons + 4, Persons + 1 + n, cmp1);

    //依题意，重新安排职位
    for (int i = 1; i <= n; i++) {
        if (i == 1) Persons[i].NewZhiWei = "BangZhu";
        else if (i == 2 || i == 3) Persons[i].NewZhiWei = "FuBangZhu";
        else if (i == 4 || i == 5) Persons[i].NewZhiWei = "HuFa";
        else if (i >= 6 && i <= 9) Persons[i].NewZhiWei = "ZhangLao";
        else if (i >= 10 && i <= 16) Persons[i].NewZhiWei = "TangZhu";
        else if (i >= 17 && i <= 41) Persons[i].NewZhiWei = "JingYing";
        else Persons[i].NewZhiWei = "BangZhong";
    }

    //二轮排序
    sort(Persons + 1, Persons + 1 + n, cmp2);

    //输出结果
    for (int i = 1; i <= n; i++)
        cout << Persons[i].Name << " " << Persons[i].NewZhiWei << " " << Persons[i].DengJi << endl;
    return 0;
}
