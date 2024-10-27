str = input("请输入字符串")
reverse_str = str[::-1]
if str == reverse_str:
    print(str+"是特殊回文")
else:
    print(str+"不是特殊回文")