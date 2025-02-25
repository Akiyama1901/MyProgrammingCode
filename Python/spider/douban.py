import requests
from readwrite import writefile
url='https://movie.douban.com/top250?start=0&filter='
h={
'user-agent':'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36'
}
data=''
for i in range(1,11):
    paras={'page':i}
    r=requests.get(url,headers=h,params=paras)
    print(r.status_code)
    print(r.request.url)
    print(r.encoding,r.apparent_encoding)
    data+=r.text

writefile("data/","douban.html",data)