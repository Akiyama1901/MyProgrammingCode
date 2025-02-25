import pandas as pd
import numpy as np

# 读取数据函数
def load_data(file_path):
    df = pd.read_csv(file_path, header=0, names=[
        "日期", "最高温度", "最低温度", "温差", "天气", "风向", "风速", "24h降水量",
        "体感温度", "日出", "日落", "月升", "月落", "空气质量AQI"
    ])
    return df

# 温度处理
def process_temperature(temp):
    try:
        return float(temp[:-1])  # 去掉温度单位（°C）并转换为浮动类型
    except ValueError:
        return np.nan  # 如果转换失败，返回 NaN

# 空气质量级别
def aqi_level(aqi):
    if pd.isna(aqi):
        return "未知"
    if aqi <= 50:
        return "优"
    elif 50 < aqi <= 100:
        return "良"
    elif 100 < aqi <= 150:
        return "轻度污染"
    elif 150 < aqi <= 200:
        return "中度污染"
    elif 200 < aqi <= 300:
        return "重度污染"
    else:
        return "严重污染"

# 时间处理
def process_time(time_str):
    time = pd.to_datetime(time_str, format="%H:%M", errors='coerce')
    return (time.hour + time.minute / 60) if time_str not in ['/', ''] else np.nan

# 数据分析
def analyze_weather_data(df):
    # 温度处理
    df["最高温度"] = df["最高温度"].apply(process_temperature)
    df["最低温度"] = df["最低温度"].apply(process_temperature)
    df["温差"] = df["温差"].apply(process_temperature)
    df["体感温度"] = df["体感温度"].apply(process_temperature)

    # 计算平均温度
    average_max_temp = df["最高温度"].mean()
    average_min_temp = df["最低温度"].mean()
    print(f"平均最高温度：{average_max_temp:.2f}°C")
    print(f"平均最低温度：{average_min_temp:.2f}°C")

    # 统计降水天数
    rainy_days = df[df["24h降水量"] != "0mm"].shape[0]
    print(f"降水天数：{rainy_days}天")

    # 计算空气质量等级
    df["空气质量等级"] = df["空气质量AQI"].apply(aqi_level)

    # 处理日出和日落时间
    df["处理后日出"] = df["日出"].apply(process_time)
    df["处理后日落"] = df["日落"].apply(process_time)
    df["日照时长"] = df["处理后日落"] - df["处理后日出"]
    average_sunshine_duration = df["日照时长"].mean()
    print(f"平均日照时长：{average_sunshine_duration:.2f}小时")

    # 计算夜长：夜间时长 = 24 - 日照时长
    df["夜长"] = 24 - df["日照时长"]
    average_night_duration = df["夜长"].mean()
    print(f"平均夜长：{average_night_duration:.2f}小时")

    # 多云天气和晴天天数统计
    cloudy_days = df[df["天气"].str.contains("多云", na=False)].shape[0]
    sunny_days = df[df["天气"].str.contains("晴", na=False)].shape[0]
    print(f"多云天数：{cloudy_days}天")
    print(f"晴天数：{sunny_days}天")

    # 保留两位小数
    df["最高温度"] = df["最高温度"].round(2)
    df["最低温度"] = df["最低温度"].round(2)
    df["温差"] = df["温差"].round(2)
    df["体感温度"] = df["体感温度"].round(2)
    df["日照时长"] = df["日照时长"].round(2)
    df["夜长"] = df["夜长"].round(2)

    df.replace("/", np.nan, inplace=True)
    df.drop(columns=["处理后日出", "处理后日落"], inplace=True)

    return df

def save_analysis(df, output_path):
    df.to_csv(output_path, index=False)
    print(f"分析后的数据已保存为 {output_path}")

def main():
    file_path = "data/xiamen_weather.csv"
    output_path = "data/xiamen_weather_analysis.csv"
    df = load_data(file_path)
    df = analyze_weather_data(df)
    save_analysis(df, output_path)

main()