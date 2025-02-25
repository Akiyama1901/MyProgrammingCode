import requests
from readWrite import writefile

def fetch_html(url, headers):
        r = requests.get(url, headers=headers)
        print(r.status_code)
        print(r.request.url)
        print(r.encoding,r.apparent_encoding)
        return r.text

def save_html_to_file(data, filepath, filename):
    if data:
        writefile(filepath, filename, data)
        print(f"文件已保存至 {filepath}/{filename}")
    else:
        print("没有数据可以保存。")

def main():
    url = 'https://datashareclub.com/area/%E7%A6%8F%E5%BB%BA/%E5%8E%A6%E9%97%A8.html'
    headers = {
        'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36'
    }

    data = fetch_html(url, headers)
    save_html_to_file(data, "data", "xiamen.html")

main()