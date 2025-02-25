import pandas as pd
import numpy as np
from bs4 import BeautifulSoup
import requests
from ReadWritefile import readfile,writefile

url="https://www.shanghairanking.cn/rankings/bcur/2024"

def get_html_text(url):
    head={
        'user-agent':"Chrome/5.0"
    }
    r= requests.get(url)
    r.encoding=r.apparent_encoding
    print(r.status_code)
    return r.text

def parse_text(text):
    soup=BeautifulSoup(text,"html.parser")
    trs = soup.tbody.find_all("tr")
    # tbody =soup.tbody

    data=[]
    # for tr in tbody.children:
    for tr in trs:
        str=list(tr.stripped_strings)
        # print(str)
        tmp=[str[0],str[1],str[4],str[5],str[6]]
        data.append(tmp)
    return data

def savedata(data):
    df=pd.DataFrame(np.array(data),columns=["排名","名称","省市","类型","总分"])
    df.to_csv("data/school_rank.csv",index=False)
    print(df)

def main():
    text =get_html_text(url)
    writefile("data","school_rank.html",text)
    data=parse_text(text)
    savedata(data)

main()