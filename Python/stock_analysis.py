import csv
import matplotlib.pyplot as plt
import numpy as np

# 读取CSV文件
with open('stock_data.csv', 'r', encoding='utf-8') as f:
    reader = csv.reader(f)
    # 读取列标题
    headers = next(reader)
    print("列标题：", headers[1:])  # 跳过第一列序号
    
    # 读取数据到列表
    data = []
    for row in reader:
        data.append(row[1:])  # 跳过第一列序号

# 将字符串数据转换为数值型
volume_data = [float(row[headers[1:].index('volume')]) for row in data]

# 3. 计算成交量统计数据
volume_stats = {
    '最小值': min(volume_data),
    '最大值': max(volume_data),
    '平均值': round(sum(volume_data) / len(volume_data), 2),
    '标准差': round(np.std(volume_data), 2),
    '总和': sum(volume_data)
}

print("\n成交量：", end=' ')
for key, value in volume_stats.items():
    print(f"{key}= {value}", end=' ')

# 4. 绘制最近100天收盘价与最高价的对比图
plt.figure(figsize=(12, 6))

# 获取最后100天的数据
last_100_days = data[-100:]
close_idx = headers[1:].index('close')
high_idx = headers[1:].index('high')

close_prices = [float(row[close_idx]) for row in last_100_days]
high_prices = [float(row[high_idx]) for row in last_100_days]
x = range(1, 101)

plt.plot(x, close_prices, label='close price')
plt.plot(x, high_prices, label='high price')

plt.title('股票收盘价与最高价对比趋势图')
plt.xlabel('Date')
plt.ylabel('Stock Price')
plt.legend()
plt.grid(True)

# 保存图片
plt.savefig('399932_price.png')
plt.close() 