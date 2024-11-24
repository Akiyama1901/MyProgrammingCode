import csv

def readtxt(file):
    result = []
    with open(file, "r") as f:
        for line in f:
            result.append(line[:6])
    return result

def writecsv(file, data):
    with open(file, "w", newline="") as f:
        writer = csv.writer(f)
        writer.writerows(data)

def readcsv(file):
    result = {}
    with open(file, "r", encoding="gbk") as f:
        reader = csv.reader(f)
        for row in reader:
            result[row[0]] = row[1]
    return result