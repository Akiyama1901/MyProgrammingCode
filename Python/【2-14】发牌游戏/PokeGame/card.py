class Card:
    def __init__(self, rank, suit):
        self.rank = rank
        self.suit = suit

# 得到一个对象的字符串表示形式
    def __repr__(self):
        ranks = ['','A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K']
        return f"{self.suit}{ranks[self.rank]}"