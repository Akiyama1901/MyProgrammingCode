weight = eval(input("体重（公斤）："))
height = eval(input("身高（米）："))
BMI = weight / height**2
print("你的身体质量指数：%.2f"%BMI)
print("你的身体质量指数：{:.2f}".format(BMI))
