import matplotlib.pyplot as plt
import matplotlib
import csv
import numpy as np
matplotlib.rcParams['font.family'] = "Kaiti"

date = []
closing_price = []
pre_closing_price=[]
opening_price=[]
trade_volume=[]
trend=[]
with open("002594.csv", 'r', encoding='utf-8') as f:
    re = csv.reader(f)
    for line in re:
        if re.line_num>1:
            date.append(line[0])
            closing_price.append(float(line[6]))
            pre_closing_price.append(float(line[7]))
            opening_price.append(float(line[3]))
            trade_volume.append(float(line[10]))
            if float(line[6])-float(line[7])>0:
                trend.append(1)
            else:
                trend.append(0)
    # print(date)
    # print(closing_price)
    # print(pre_closing_price)
    # print(opening_price)
    # print(trade_volume)
    # print(trend)
plt.figure(figsize=(15, 20))

# 第一个
plt.subplot(221)
plt.title("收盘价与前收盘对比折线图")
plt.xlabel("日期")
plt.ylabel("股票价格")
plt.plot(date, pre_closing_price, color="blue", linewidth=2, linestyle="-")
plt.plot(date, closing_price, color="green", linewidth=2, linestyle="-.")
plt.legend(labels=["前收盘", "收盘价"])
plt.xticks(np.arange(0,30.1,5))

# 第二个
plt.subplot(222)
plt.title("开盘价与收盘价对比折线图")
plt.xlabel("日期")
plt.ylabel("股票价格")
plt.plot(date, opening_price, color="black", linewidth=2, linestyle="-")
plt.plot(date, closing_price, color="red", linewidth=2, linestyle="--")
plt.legend(labels=["开票价", "收盘价"])
plt.xticks(np.arange(0,30.1,5))

#第三个
plt.subplot(223)
plt.title("成交量柱状趋势图")
plt.xlabel("日期")
plt.ylabel("成交量")
plt.bar(date, trade_volume)
plt.xticks(np.arange(0,30.1,5))

#第四个
plt.subplot(224)
plt.title("涨停柱状图")
plt.xlabel("日期")
plt.ylabel("涨跌否")
plt.bar(date, trend,color="green")
plt.xticks(np.arange(0,31,5))
plt.yticks(np.arange(0,1.1,1),fontsize=12,fontweight='bold')

plt.show()