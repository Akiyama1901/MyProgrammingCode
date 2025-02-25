import os
def writefile(fpath,filename,data):
    if os.path.exists(fpath)==False:
        os.mkdir(fpath)
    file = fpath+filename
    with open(file,"w+",encoding='utf-8') as f:
        f.write(data)

def readfile(file):
    with open(file,"r",encoding='utf-8') as f:
        data =f.read()
        return data