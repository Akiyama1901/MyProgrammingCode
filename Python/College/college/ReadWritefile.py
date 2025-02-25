#coding:utf-8
import csv
import os

#爬取到的内容存入文件中
def writefile(fpath,filename,text):
    if os.path.exists(fpath)==False:
        os.mkdir(fpath)
    file = fpath+"/"+filename
    with open(file,"w+",encoding="utf-8") as f:
        f.write(text)

def readfile(file):
    with open(file,"r",encoding="utf-8") as f:
        str=f.read()
    return str

def writecsv(file,rows):
    with open(file,"w+",encoding="utf-8",newline="") as f:
        writer = csv.writer(f)
        writer.writerows(rows)

def readcsv(file):
    with open(file, "r+", encoding="utf-8", newline="") as f:
        reader = csv.reader(f)
        data=[]
        for row in reader:
            data.append(row)
            print(row[1])
    return data








# def writecsv(file,rows):
#     with open(file,"w+",newline="",encoding='utf-8') as f:
#         writer = csv.writer(f)
#         writer.writerows(rows)
#
# def readcsv(file):
#     with open(file,"r+",newline="",encoding='utf-8') as f:
#         reader = csv.reader(f)
#         print(type(reader))
#         data=[]
#         for row in reader:
#             data.append(row)
#             print(row[0],row[1])
#         return data
