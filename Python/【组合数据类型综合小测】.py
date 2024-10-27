dic = {350203: "思明区",350205:"海沧区",350206:"湖里区",350211:"集美区",350212:"同安区"}
s = '''
350205198304214221
350203198304214221
350205198004214221
350211198004214221
350212200104144221
350211202106214221
350206198304214221
350205199204214221
350203200901214221
350211198504214221
'''
id = s.split();
count = {}
for item in id:
    key = int(item[:6])
    area = dic.get(key, None)
    if area not in count:
        count[area] = 1
    else:
        count[area] += 1
print(f"总共统计了{len(id)}个人的身份证号，分别来自厦门如下地区：")
result = {area: count for area, count in count.items()}
print(result)