from tkinter import *
from tkinter import messagebox

import pygame
import sys

class Game:
    """Класс для создания игрового окна"""

    def __init__(self, caption, width, height, sound, field):
        self.game_over = False
        self.field = field
        self.menu_button = Button(150, 65, 495, 355)
        pygame.init()
        self.screen = pygame.display.set_mode((width, height))
        pygame.display.set_caption(caption)
        pygame.mixer.music.load(sound)

    @staticmethod
    def play_sound():
        pygame.mixer.music.play()

    def handle_events(self):
        for event in pygame.event.get():
            if event.type == pygame.QUIT:
                self.finish_game()
            if event.type == pygame.MOUSEBUTTONDOWN:
                (posx, posy) = pygame.mouse.get_pos()
                self.field.set_chip(posx)
                if self.menu_button.x < posx < self.menu_button.x + self.menu_button.width and self.menu_button.y < posy < self.menu_button.y + self.menu_button.height:
                    self.finish_game()

    def run(self):
        while not self.game_over:
            self.handle_events()
            self.screen.fill(BLACK)
            field.draw()
            quit_text = my_font.render('Quit', True, WHITE)
            self.menu_button.draw(game.screen, quit_text, WHITE, BLACK)
            pygame.display.flip()

    @staticmethod
    def finish_game():
        pygame.quit()
        sys.exit()


class Chip:
    """Класс для рисования фишек на поле"""

    def __init__(self, x, y):
        self.color = WHITE
        self.rect = (x, y, 65, 65)

    def draw(self, screen):
        pygame.draw.rect(screen, self.color, self.rect)


class Button:
    """Класс для создания кнопок"""

    def __init__(self, width, height, x, y):
        self.width = width
        self.height = height
        self.x = x
        self.y = y

    def draw(self, screen, text, rect_color, border_color):
        border = 2
        pygame.draw.rect(screen, rect_color, (self.x, self.y, self.width, self.height))
        pygame.draw.rect(screen, border_color,
                         (self.x + border, self.y + border, self.width - border * 2, self.height - border * 2))
        screen.blit(text, (self.x + self.width / 6, self.y + self.height / 7))


class Field:
    """Класс для создания поля"""
    
    turn = 0

    def __init__(self, columns, rows):
        self.rows = rows
        self.columns = columns
        self.chips = [[Chip(x, y) for y in columns] for x in rows]

    def get_position(self, pos_x):
        self.rows.append(pos_x)
        self.rows.sort()
        try:
            return self.rows.index(pos_x) - 1
        finally:
            self.rows.remove(pos_x)

    def draw(self):
        for i in self.chips:
            for chip in i:
                chip.draw(game.screen)

    def set_chip(self, pos_x):
        column = self.get_position(pos_x)
        if column >= 0 and pos_x < self.rows[column] + 70:
            for chip in self.chips[column][::-1]:
                if chip.color == WHITE:
                    if Field.turn == 0:
                        chip.color = RED
                        game.play_sound()
                    else:
                        chip.color = YELLOW
                        game.play_sound()
                    Field.turn = 1 - Field.turn
                    break
        self.win()

    def win(self):
        full = 0
        #field is full
        for i in range(len(self.chips) - 1):
            for j in range(len(self.chips)):
                if self.chips[j][i].color != WHITE:
                    full += 1
                    if full == 30:
                        Tk().wm_withdraw()
                        messagebox.showinfo('Result', 'no one won')
                
        #horizontal
        for i in range(len(self.chips)):
            for j in range(len(self.chips) - 3):
                if self.chips[j][i].color == RED and self.chips[j + 1][i].color == RED and self.chips[j + 2][i].color == RED and self.chips[j + 3][i].color == RED or \
                   self.chips[j][i].color == YELLOW and self.chips[j + 1][i].color == YELLOW and self.chips[j + 2][i].color == YELLOW and self.chips[j + 3][i].color == YELLOW:
                    Tk().wm_withdraw()
                    messagebox.showinfo('Result', f"{self.chips[j][i].color} is a winner")
        
        # vertical
        for i in range(len(self.chips) - 3):
            for j in range(len(self.chips)):
                if self.chips[j][i].color == RED and self.chips[j][i + 1].color == RED and self.chips[j][i + 2].color == RED and self.chips[j][i + 3].color == RED or \
                   self.chips[j][i].color == YELLOW and self.chips[j][i + 1].color == YELLOW and self.chips[j][i + 2].color == YELLOW and self.chips[j][i + 3].color == YELLOW:
                    Tk().wm_withdraw()
                    messagebox.showinfo('Result', f"{self.chips[j][i].color} is a winner")
        # diagonal left
        for i in range(len(self.chips) - 3):
            for j in range(len(self.chips) - 3):
                if self.chips[j][i].color == RED and self.chips[j + 1][i + 1].color == RED and self.chips[j + 2][i + 2].color == RED and self.chips[j + 3][i + 3].color == RED or \
                   self.chips[j][i].color == YELLOW and self.chips[j + 1][i + 1].color == YELLOW and self.chips[j + 2][i + 2].color == YELLOW and self.chips[j + 3][i + 3].color == YELLOW:
                    Tk().wm_withdraw()
                    messagebox.showinfo('Result', f"{self.chips[j][i].color} is a winner")
        # diagonal right
        for i in range(len(self.chips) - 3):
            for j in range(3, len(self.chips)):
                if self.chips[j][i].color == RED and self.chips[j - 1][i + 1].color == RED and self.chips[j - 2][i + 2].color == RED and self.chips[j - 3][i + 3].color == RED or \
                   self.chips[j][i].color == YELLOW and self.chips[j - 1][i + 1].color == YELLOW and self.chips[j - 2][i + 2].color == YELLOW and self.chips[j - 3][i + 3].color == YELLOW:
                    Tk().wm_withdraw()
                    messagebox.showinfo('Result', f"{self.chips[j][i].color} is a winner")

YELLOW = 'yellow'
WHITE = 'white'
BLACK = 'black'
RED = 'red'

rows = [5, 75, 145, 215, 285, 355]
columns = [5, 75, 145, 215, 285, 355]

field = Field(columns, rows)
game = Game("4 in row", 650, 425, 'click.mp3', field)

my_font = pygame.font.SysFont('monospace', 42)
game.run()
