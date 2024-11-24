import matplotlib
import matplotlib.pyplot as plt
import numpy as np
import csv
x = []
y1 = []
with open("movietop25.csv", 'r', encoding='utf-8') as f:
    re = csv.reader(f)
    for line in re:
        x.append(line[0])
        y1.append(float(line[1]))
y2 = [9.3, 9.4, 9.5, 9.6, 9.7]
matplotlib.rcParams['font.family'] = "Kaiti"
plt.figure(figsize=(10, 6))
plt.title("电影评分")
plt.xlabel("名称")
plt.ylabel("评分")
plt.ylim(9, 10)
plt.plot(x, y1, color="red", linewidth=3, linestyle="--")
plt.plot(x, y2, color="green", linewidth=3, linestyle="-")
plt.legend(labels=["豆瓣评分", "腾讯平台"])
plt.savefig("test.png")
plt.show()