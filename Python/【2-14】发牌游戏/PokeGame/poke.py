import random
from card import Card

class Poke:
    def __init__(self):
        self.cards = []
        self.create_cards()

    def create_cards(self):
        suits = ["梅花", "方块", "红桃", "黑桃"]
        for suit in suits:
            for rank in range(1, 14):
                card = Card(rank, suit)
                self.cards.append(card)

    def shuffle(self):
        random.shuffle(self.cards)

    def disbute(self, cards):
        disbuted_cards = []
        for _ in range(cards):
                card = self.cards.pop(0)
                disbuted_cards.append(card)
        return disbuted_cards