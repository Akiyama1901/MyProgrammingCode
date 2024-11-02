def idTodate(ids):
    result = {}
    for id in ids:
        birthday = id[6:14]
        if birthday not in result:
            result[birthday] = 1
        else:
            result[birthday] += 1
    return result

# 测试
id = ["445381199305052534","350221200108269300","350431200108269341","222333198004076666"]
result = idTodate(id)
print("提取到的出生日期及对应人数如下所示：")
for birthday, count in sorted(result.items()):
    print(birthday +":"+ str(count))