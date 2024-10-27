import random

def coin():
    type = random.choice(["heads","tails"])
    return type

def dice():
    ans = random.randint(1,6)
    return ans

def count_coin(results):
    heads = 0
    tails = 0
    for result in results:
        if result == "heads":
            heads += 1
        else:
            tails += 1
    return heads, tails

def count_dice(results):
    count_dict = {}
    for result in results:
        result = str(result)
        if result not in count_dict:
            count_dict[result] = 0
        count_dict[result] += 1
    return count_dict

coinresults = []
diceresults = []
for _ in range(10):
    coinresults.append(coin())
    diceresults.append(dice())

heads_count, tails_count = count_coin(coinresults)
dice_count = count_dice(diceresults)
print("抛硬币10次的结果:")
print(coinresults)
print("掷骰子10次的结果:")
print(diceresults)
print("正面(heads)出现的次数:", heads_count)
print("反面(tails)出现的次数:", tails_count)
print("每个点数出现的次数:", dice_count)