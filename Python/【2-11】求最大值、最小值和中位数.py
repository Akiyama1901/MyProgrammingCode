def remove(list):
    processed = []
    for x in list:
        if x not in processed:
            processed.append(x)
    return processed

def max(list):
    result = list[0]
    for x in list:
        if x > result:
            result = x
    return result

def min(list):
    result = list[0]
    for x in list:
        if x < result:
            result = x
    return result

def middle(list):
    sorted_list = sorted(list)
    length = len(sorted_list)
    if length % 2 == 0:
        result = (sorted_list[length // 2 - 1] + sorted_list[length // 2]) / 2
    else:
        result = sorted_list[length // 2]
    return result

n = eval(input("请输入你要输入的元素个数: "))
input_list = []
for i in range(n):
    number = int(input(f"请输入第{i + 1}个数: "))
    input_list.append(number)

processed_list = remove(input_list)
max_val = max(processed_list)
min_val = min(processed_list)
middle_val = middle(processed_list)

print("输入数据:", input_list)
print("去重数据:", processed_list)

sorted_list = sorted(processed_list)
print("排序数据:", sorted_list)
print("最大值=", max_val, "最小值=", min_val, "中位数=", middle_val)
