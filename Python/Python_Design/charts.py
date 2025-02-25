import matplotlib
import matplotlib.pyplot as plt
import numpy as np
from readWrite import readcsv
matplotlib.rcParams['font.family'] = "SimHei"


def plot_temperature_trend(dates, max_temps, min_temps):
    plt.figure(figsize=(16, 8))

    for i, txt in enumerate(max_temps):
        plt.text(dates[i], max_temps[i] + 0.6, f'{txt}°C', va='top', fontsize=10)
    for i, txt in enumerate(min_temps):
        plt.text(dates[i], min_temps[i] - 0.6, f'{txt}°C', va='top', fontsize=10)

    plt.plot(dates, max_temps, label='最高温度', color='red', marker='s', linestyle='-', linewidth=2)
    plt.plot(dates, min_temps, label='最低温度', color='blue', marker='o', linestyle='-.', linewidth=2)

    plt.title('近一个月厦门最高温度与最低温度变化趋势', fontsize=16)
    plt.xlabel('日期', fontsize=12)
    plt.ylabel('温度 (°C)', fontsize=12)
    plt.xticks(rotation=45)
    plt.legend()
    plt.savefig("fig/近一个月厦门最高温度与最低温度变化趋势.png")
    plt.show()


def plot_temperature_diff(dates, temperature_diff):

    plt.figure(figsize=(16, 8))
    plt.bar(dates, temperature_diff, color='green', width=0.6)

    # 在每个条形图上显示温差值
    for i, diff in enumerate(temperature_diff):
        plt.text(dates[i], diff + 0.2, f'{diff:.2f}°C', ha='center', fontsize=10)

    plt.title('近一个月厦门每日温差变化', fontsize=16)
    plt.xlabel('日期', fontsize=12)
    plt.ylabel('温差 (°C)', fontsize=12)
    plt.xticks(rotation=45)
    plt.savefig("fig/近一个月厦门每日温差变化.png")
    plt.show()


def plot_weather_distribution(weather_counts):
    labels = list(weather_counts.keys())
    sizes = list(weather_counts.values())
    colors = ['red', 'blue', 'yellow', 'green', 'orange', 'cyan']
    explode = (0.1, 0, 0, 0, 0, 0)

    plt.figure(figsize=(8, 8))
    plt.pie(sizes, labels=labels, autopct='%1.1f%%', startangle=90, colors=colors, explode=explode)
    plt.title('近一个月厦门天气类型分布', fontsize=16)
    plt.savefig("fig/近一个月厦门天气类别表.png")
    plt.show()


def plot_temperature_comparison(dates, max_temps, feels_temps, min_temps):

    bar_width = 0.25
    index = np.arange(len(dates))
    plt.figure(figsize=(16, 8))

    # 绘制每种温度的柱状图
    plt.bar(index - bar_width, max_temps, bar_width, label='最高温度', color='red')
    plt.bar(index, feels_temps, bar_width, label='体感温度', color='green')
    plt.bar(index + bar_width, min_temps, bar_width, label='最低温度', color='blue')

    plt.title('近一个月体感温度与实际温度对比', fontsize=16)
    plt.xlabel('日期', fontsize=12)
    plt.ylabel('温度 (°C)', fontsize=12)
    plt.xticks(index, dates, rotation=45)
    plt.legend()
    plt.savefig("fig/近一个月体感温度与实际温度对比柱状图.png")
    plt.show()


def plot_time(dates, sunrise, sunset, sunshine_duration, night_time):
    plt.figure(figsize=(18, 20), constrained_layout=True)
    plt.suptitle("厦门近一个月昼夜时间分析")

    # 第一个：日出折线图
    plt.subplot(221)
    plt.title("日出折线图")
    plt.xlabel("日期")
    plt.ylabel("日出时间")
    plt.plot(dates, sunrise, color="orange", linewidth=2, linestyle="-")
    plt.xticks(rotation=45)

    # 第二个：日落折线图
    plt.subplot(222)
    plt.title("日落折线图")
    plt.xlabel("日期")
    plt.ylabel("日落时间")
    plt.plot(dates, sunset, color="red", linewidth=2, linestyle="--")
    plt.xticks(rotation=45)

    # 第三个：日照时间折线图
    plt.subplot(223)
    plt.title("日照时间折线图")
    plt.xlabel("日期")
    plt.ylabel("日照时长 (小时)")
    plt.plot(dates, sunshine_duration, color="green", linewidth=2, linestyle="-.")
    plt.xticks(rotation=45)

    # 第四个：夜长柱状图
    plt.subplot(224)
    plt.title("夜长柱状图")
    plt.xlabel("日期")
    plt.ylabel("时间")
    bar_width = 0.35
    plt.bar(np.arange(len(night_time)), night_time, bar_width, label="夜长", color="blue")
    plt.xticks(np.arange(0, len(dates), 3), dates[::3], rotation=45)
    plt.legend()
    plt.savefig('fig/厦门近一个月昼夜时间分析.png')
    plt.show()


def main():
    data = readcsv("data/xiamen_weather_analysis.csv")
    dates = [row[0][5:] for row in data[1:]]
    max_temps = [float(row[1]) for row in data[1:]]
    min_temps = [float(row[2]) for row in data[1:]]
    feels_temps = [float(row[8]) for row in data[1:]]
    temperature_diff = [float(row[3]) for row in data[1:]]

    weather_types = ["晴", "多云", "多云转晴", "多云转阴", "小雨转多云", "小雨"]
    weather_counts = {weather: 0 for weather in weather_types}
    for row in data[1:]:
        weather = row[4]
        for i in weather_types:
            if i in weather:
                weather_counts[i] += 1

    # 绘制图表
    plot_temperature_trend(dates, max_temps, min_temps)
    plot_temperature_diff(dates, temperature_diff)
    plot_weather_distribution(weather_counts)
    plot_temperature_comparison(dates, max_temps, feels_temps, min_temps)

    # 获取日出、日落、日照时长和夜长
    sunrise = [row[9] for row in data[1:]]
    sunset = [row[10] for row in data[1:]]
    sunshine_duration = [float(row[15]) if row[15] else np.nan for row in data[1:]]
    night_time = [row[16] for row in data[1:]]
    plot_time(dates, sunrise, sunset, sunshine_duration, night_time)

main()