char = eval(input())
try:
    items = list(char.items())
    reverse = {}
    for i in range(len(items)):
        keys, values = items[i]
        reverse[values] = keys
    print(reverse)
except:
    print('输入错误')
