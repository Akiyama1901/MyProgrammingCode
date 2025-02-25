import pandas as pd
import numpy as np
from bs4 import BeautifulSoup
from ReadWritefile import readfile

text = readfile("data/douban250.html")
# print(text)

soup =BeautifulSoup(text,"html.parser")
node_title=soup.body.find_all("span",class_="title")
movie_name=[]
for i in node_title:
    name=i.string.strip()
    if name[0]=="/":
        continue
    else:
        movie_name.append(name)
print(movie_name)
node_scores=soup.body.find_all("span",class_="rating_num")

# string strinds stripped_strings
movie_scores=[]
for i in node_scores:
    movie_scores.append(i.string)
print(movie_scores)

df=pd.DataFrame({"排名":np.arange(1,len(movie_name)+1),
                 "片名":movie_name,
                 "评分":movie_scores})
df.to_csv("data/movie250.csv",index=False)
print(df)