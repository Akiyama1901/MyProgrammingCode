class Animal:
    def __init__(self,species):
        self.species = species
    def eat(self,food):
        print("{}吃{}".format(self.species, food))
    def sleep(self):
        print("{}睡觉打呼噜".format(self.species))

class Pet(Animal):
    def __init__(self, species):
        super().__init__(species)

class Rabbit(Pet):
    def __init__(self):
        super().__init__("兔子")

class Tiger(Pet):
    def __init__(self):
        super().__init__("老虎")

rabbit = Rabbit()
tiger = Tiger()

print("——————主人开始喂养兔子：——————")
rabbit.eat("草")
rabbit.sleep()

print("——————主人开始喂养老虎：——————")
tiger.eat("肉")
tiger.sleep()

print()

class Rabbit:
    def __init__(self):
        self.species = "兔子"

    def eat(self):
        print(self.species,"吃草")
    def sleep(self):
        print(self.species,"睡觉打呼噜")

class Tiger:
    def __init__(self):
        self.species = "老虎"

    def eat(self):
        print(self.species,"吃肉")

    def sleep(self):
        print(self.species,"睡觉打呼噜")

def feed_and_rest(animal):
    animal.eat()
    animal.sleep()

rabbit = Rabbit()
tiger = Tiger()

print("——————主人开始喂养兔子：——————")
feed_and_rest(rabbit)

print("——————主人开始喂养老虎：——————")
feed_and_rest(tiger)

#coding:utf-8

#定义父类Animal
class Animal:
    species='动物'
    def __init__(self,species):
        self.species=species

    def eat(self):
        print("动物在吃东西")
    def sleep(self):
        print(self.species,"睡觉打呼噜",sep="")

#定义兔子类
class Rabbit(Animal):
    def __init__(self,species):
        super().__init__(species)

    #重写eat
    def eat(self):
        print("兔子吃草")

#定义老虎类
class Tiger(Animal):
    def __init__(self,species):
        super().__init__(species)

    #重写eat
    def eat(self):
        print("老虎吃肉")

class Master:
    def feed(self,animal):
        animal.eat()
        animal.sleep()

#实例化兔子和老虎
rabbit = Rabbit("兔子")
tiger = Tiger("老虎")
master = Master()
print("-------主人开始喂养兔子：-------")
master.feed(rabbit)
print("-------主人开始喂养老虎：-------")
master.feed(tiger)