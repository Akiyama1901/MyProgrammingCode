import os
import csv

def readfile(file):
    with open(file,"r",encoding="utf-8") as f:
        text=f.read()
    return text

def writefile(fpath,filename,text):
    if os.path.exists(fpath)==False:
        os.mkdir(fpath)
    file = fpath+"/"+filename

    with open(file,"w+",encoding="utf-8") as f:
        f.write(text)

def readcsv(file):
    with open(file, "r+", encoding="utf-8", newline="") as f:
        r = csv.reader(f)
        data=[]
        for line in r:
            data.append(line)
    return data

def writecsv(file,rows):
    with open(file,"w+",encoding="utf-8",newline="") as f:
        w = csv.writer(f)
        w.writerows(rows)