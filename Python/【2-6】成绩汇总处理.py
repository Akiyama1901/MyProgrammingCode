scores = [25,87,98,87,99,100,67,86,35,56,47,94,56,76,24,97,24,100,23,65,73,93,78,100,44,66,90,70,61,12]

# 班级人数
num = len(scores)

# 平均分
total = 0
for score in scores:
    total += score
avg_score = round(total / num, 1)

# 最高分
high = scores[0]
for score in scores:
    if score > high:
        high = score

# 最低分
low = scores[0]
for score in scores:
    if score < low:
        lowest = score

# 获得最高分的学号
students = []
index = 1
for score in scores:
    if score == high:
        students.append(index)
    index += 1

# 班级前五名成绩
scores.sort(reverse=True)
top_five = scores[:5]

print(f"班级人数: {num}")
print(f"班级平均分是: {avg_score}"f", 最高分是: {high}"f", 最低分是: {low}")
print(f"获得最高分的学号是: {students}")
print(f"班级前五名成绩是: {top_five}")
