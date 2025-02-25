import requests
from bs4 import BeautifulSoup
from readWrite import readfile, writecsv

def parse_html_to_data(text):
    soup = BeautifulSoup(text, "html.parser")
    # 定位到 class="card-body p-2" 的 div
    card_body = soup.find("div", class_="card-body p-2")
    trs = card_body.find_all("tr")

    header_row = ['日期', '最高温度', '最低温度', '温差', '天气', '风向/风速', '24h降水量', '体感温度', '日出/日落',
                  '月升/月落', '空气质量AQI']
    data = [header_row]

    for tr in trs:
        str_list = list(tr.stripped_strings)
        if str_list == header_row:
            continue

        date = str_list[0]  # 日期
        max_temp = str_list[1]  # 最高温度
        min_temp = str_list[2]  # 最低温度
        temp_diff = str_list[3]  # 温差
        weather = str_list[4]  # 天气
        wind = str_list[5]  # 风向
        level = str_list[6]  # 风速
        precipitation = str_list[7]  # 24小时降水量
        feel_temp = str_list[8]  # 体感温度
        sunrise = str_list[9][:5]  # 日出
        sunset = str_list[9][6:]  # 日落
        moonrise = str_list[10][:5]  # 月升
        moonset = str_list[10][6:]  # 月落
        aqi = str_list[11]  # 空气质量AQI

        data.append([date, max_temp, min_temp, temp_diff, weather, wind, level, precipitation, feel_temp,
                     sunrise, sunset, moonrise, moonset, aqi])

    return data

def main():
    text = readfile("data/xiamen.html")
    data = parse_html_to_data(text)
    writecsv("data/xiamen_weather.csv", data)
    print("文件已保存至xiamen_weather.csv")

main()