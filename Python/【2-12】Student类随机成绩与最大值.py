import random

class Student:
    def Set_info(self, id, name, chinese, mathematics, english):
        self.__id = id
        self.name = name
        self.Chinese = chinese
        self.Mathematics = mathematics
        self.English = english
        self.sum = chinese + mathematics + english

    def info(self):
        print("姓名：", self.name)
        print("学号：", self.__id)
        print("语文成绩：", self.Chinese)
        print("数学成绩：", self.Mathematics)
        print("英语成绩：", self.English)
        print("总分：", self.sum)

students = []
names = ["张三", "李四", "王五", "赵六", "孙七"]

for i in range(5):
    student = Student()
    name = names[i]
    id = "ITT2300" + str(i + 1)

    chinese = random.randint(0, 100)
    mathematics = random.randint(0, 100)
    english = random.randint(0, 100)

    student.Set_info(id, name, chinese, mathematics, english)
    students.append(student)

best_student = students[0]
for student in students:
    if student.sum > best_student.sum:
        best_student = student
best_student.info()