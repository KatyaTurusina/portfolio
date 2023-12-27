import pygame
pygame.init()

W, H = 1000, 750
sc = pygame.display.set_mode((W, H))
bg = pygame.image.load('bg.png').convert()
font = pygame.font.Font(None, 70)
ending = font.render("Game over", True, (255, 0, 255))

clock = pygame.time.Clock()
from pygame.locals import (
    K_UP,
    K_DOWN,
    K_LEFT,
    K_RIGHT,
    K_ESCAPE,
    KEYDOWN,
    QUIT,
    RLEACCEL
)

class dog(pygame.sprite.Sprite):
    def __init__(self, x, speed):
        pygame.sprite.Sprite.__init__(self)
        self.image = pygame.image.load("dog.png").convert_alpha()
        self.rect = self.image.get_rect(center = (x, 0))
        self.speed = speed
    def update(self):
        if self.rect.y < H:
            self.rect.y += self.speed
        else:
            self.rect.y = 0

d1 = dog(500, 1)
d2 = dog(250, 3)
d3 = dog(100, 2)
d4 = dog(750, 1)
d5 = dog(850, 5)
d6 = dog(400, 2)
d7 = dog(600, 4)
dogs = pygame.sprite.Group()
dogs.add(d1, d2, d3, d4, d5, d6, d7)

class cat(pygame.sprite.Sprite):
    def __init__(self):
        pygame.sprite.Sprite.__init__(self)
        self.image = pygame.image.load("cat.png").convert_alpha()
        self.rect = self.image.get_rect(center = (500,650))
    def draw(self, surface):
        surface.blit(self.image, self.rect)
    def update(self):
        pressedKeys = pygame.key.get_pressed()
        if self.rect.left > 0:
            if pressedKeys[K_LEFT]:
                self.rect.move_ip(-5,0)

        if self.rect.right < 1000:
            if pressedKeys[K_RIGHT]:
                self.rect.move_ip(5,0)
                
c = cat()

while True:
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            pygame.quit()
    if pygame.sprite.spritecollideany(c,dogs):
        sc.fill((255, 255, 255))
        sc.blit(ending, [400,330])
        pygame.display.update()
        pygame.time.wait(2000)
        pygame.quit()
        break
        
    sc.blit(bg, (0,0))
    dogs.draw(sc)
    c.draw(sc)
    dogs.update()
    c.update()
    clock.tick(100)
    
    pygame.display.flip()
pygame.quit()
