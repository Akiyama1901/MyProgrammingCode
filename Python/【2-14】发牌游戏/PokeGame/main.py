from poke import Poke

poke = Poke()
poke.shuffle()
while True:
        try:
            n = int(input("请输入要发的牌数："))
            if n <= 0:
                print("输入的牌数必须大于0，请重新输入。")
                continue
            if n > len(poke.cards):
                print("牌数不足，最多只能发{}张牌。".format(len(poke.cards)))
                continue
            disbuted_cards = poke.disbute(n)
            print(disbuted_cards)
            if len(poke.cards) == 0:
                break
            choice = input("是否继续发牌？(Y/N)：")
            if choice.lower()!= 'y':
                break
        except ValueError:
            print("请输入有效的整数。")