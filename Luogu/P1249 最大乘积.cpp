#include<iostream>
#include<vector>
using namespace std;
int main() {
    int n;
    vector<int> num ;  //存储拆分的数
    int ans[1000] = { 0 };  //乘积
    int sum = 0;  //拆分数的和
    cin >> n;
    if (n < 5)  //特判，如果n小于5，他本身就是最优解
        cout << n << endl << n;
    else {
        for (int i = 2; sum <= n; i++) {
            num.push_back(i);
            sum += i;
       }
    }
    int k = sum - n; //超出的数
    if (k == 1) {
        num.erase(num.begin());
        num[num.size() - 1] += 1;
    }
    else {
        for (vector<int>::iterator itr = num.begin(); itr < num.end(); itr++) {
            if (*itr == k) {
                num.erase(itr);
                break;
            }
        }
    }

    //高精度
    ans[0] = num[0];
    int len = 1;
    for (int i = 1; i < num.size(); i++) {
        int a = num[i];
        for (int j = 0; j < len; j++) {
            ans[j] *= a;
        }
        for (int j = 0; j < len; j++) {  //进位
            if (ans[j] > 9) {
                ans[j + 1] += ans[j] / 10;
                ans[j] %= 10;
                if (j == len - 1)
                    len++;
            }
        } 
    }
    
    for (vector<int>::iterator itr = num.begin(); itr < num.end(); itr++)
        cout << *itr << " ";
    cout << endl;
    for (int i = len - 1; i >= 0; i--)
        cout << ans[i];
    return 0;
}
