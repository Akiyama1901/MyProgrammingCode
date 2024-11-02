#include<iostream>
using namespace std;
int main() {
    int mainGraph[505][505], subGraph[505][505];
    int n, m;
    cin >> n >> m;
    int index = 1;
    for (int i = 1; i <= n; i++) {
        for (int j = 1; j <= n; j++) {
            mainGraph[i][j] = index;
            subGraph[i][j] = index;
            index++;
        }
    }
    for (int i = 1; i <= m; i++) {
        int x, y, z, r;
        cin >> x >> y >> r >> z;
        if (z == 0) {
            for (int j = 1; j <= r; j++) {
                for (int k = 0; k <= j; k++) {
                    mainGraph[x - j][y + k] = subGraph[x - k][y - j];
                    mainGraph[x + k][y + j] = subGraph[x - j][y + k];
                    mainGraph[x + j][y - k] = subGraph[x + k][y + j];
                    mainGraph[x - k][y - j] = subGraph[x + j][y - k];
                    mainGraph[x + j][y + k] = subGraph[x - k][y + j];
                    mainGraph[x + k][y - j] = subGraph[x + j][y + k];
                    mainGraph[x - j][y - k] = subGraph[x + k][y - j];
                    mainGraph[x - k][y + j] = subGraph[x - j][y - k];
                }	
            }
        }
        else {
            for (int j = 1; j <= r; j++) {
                for (int k = 0; k <= j; k++) {
                    mainGraph[x - k][y - j] = subGraph[x - j][y + k];
                    mainGraph[x - j][y + k] = subGraph[x + k][y + j];
                    mainGraph[x + k][y + j] = subGraph[x + j][y - k];
                    mainGraph[x + j][y - k] = subGraph[x - k][y - j];
                    mainGraph[x + j][y + k] = subGraph[x + k][y - j];
                    mainGraph[x - k][y + j] = subGraph[x + j][y + k];
                    mainGraph[x - j][y - k] = subGraph[x - k][y + j];
                    mainGraph[x + k][y - j] = subGraph[x - j][y - k];
                }
            }
        }
        for (int j = 1; j <= n; j++) {
            for (int k = 1; k <= n; k++) {
                subGraph[j][k] = mainGraph[j][k];
            }
        }	
    }
    for (int j = 1; j <= n; j++) {
        for (int k = 1; k <= n; k++) {
            cout << mainGraph[j][k] << " ";
        }
        cout << endl;
    }
    return 0;
}
