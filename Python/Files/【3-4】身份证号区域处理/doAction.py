from Readwrite import readtxt, readcsv, writecsv

area_mapping = readcsv("idAreaList.csv")
id_list = readtxt("IdList.txt")
print(area_mapping)
print(id_list)
print()

area_count = {}
for id in id_list:
    area = area_mapping.get(id)
    area_count[area] = area_count.get(area, 0) + 1
print("区域人数统计:", area_count)

csv_data = [["区域", "人数"]]
for area, count in area_count.items():
    csv_data.append([area, count])

print(csv_data)

writecsv("result.csv", csv_data)
