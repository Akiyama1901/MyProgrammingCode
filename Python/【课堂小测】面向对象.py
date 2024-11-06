class Dog:
        name ="旺财"
        __type="狗"
        __fur_color="黄色"

        def Get_type(self):
            print(self.__type)
        def __change_type(self,dogtype):
            self.__type=dogtype
        def Set_type(self,dogtype):
            self.__change_type(dogtype)

        def Get_furcolor(self):
            print(self.__fur_color)
        def __change_color(self, dogcolor):
                self.__fur_color = dogcolor
        def Set_color(self, dogcolor):
            self.__change_color(dogcolor)

        def info(self):
            print(f"昵称: {self.name}, 品种: {self.__type}, 毛色: {self.__fur_color}")

        def eat(self, food):
            print(f"{self.name} is eating {food}")

        def __speak(self):
            print("汪汪汪...")
        def Get_speak(self):
            self.__speak()
        def learn_speak(self, word):
            print(word)
dog = Dog()
dog.Get_type()
dog.Get_furcolor()

dog.Set_color("黑色")
dog.Set_type("小狗")
dog.Get_type()
dog.Get_furcolor()
dog.info()
dog.eat("狗粮")
dog.Get_speak()
dog.learn_speak("hello")