import pygame, random
pygame.init()
s1 = pygame.mixer.Sound("fon.mp3")
s1.set_volume(0.3)
s1.play(-1)
s2 = pygame.mixer.Sound("apple.mp3")

WIDTH = 720
HEIGHT = 480
screen = pygame.display.set_mode((WIDTH, HEIGHT))

FPS = pygame.time.Clock()
end = pygame.font.SysFont('montserrat', 90)
end_surface = end.render('GAME OVER', True, (255, 0, 0))
end_bg = pygame.image.load('end.gif')

snake_location = [100, 50]
snake_body = [[100, 50], [90,50], [80,50]]
apple_location = [random.randint(1, 72) * 10, random.randint(1, 48) * 10]
apple_generation = True 
direction = ''

while True:
    screen.fill((0, 0, 0))
    for event in pygame.event.get():
        if event.type == pygame.QUIT:
            pygame.quit()
            break
        elif event.type == pygame.KEYDOWN:
            if event.key == pygame.K_UP:
                direction = 'UP'
            if event.key == pygame.K_DOWN:
                direction = 'DOWN'
            if event.key == pygame.K_LEFT:
                direction = 'LEFT'
            if event.key == pygame.K_RIGHT:
                direction = 'RIGHT'
    if direction == 'UP':
        snake_location[1] -= 10
    if direction == 'DOWN':
        snake_location[1] += 10
    if direction == 'LEFT':
        snake_location[0] -= 10
    if direction == 'RIGHT':
        snake_location[0] += 10
        
    snake_body.insert(0, list(snake_location))
    
    if snake_location[0] == apple_location[0] and snake_location[1] == apple_location[1]:
        apple_generation = False
    else:
        snake_body.pop()
        
    if not apple_generation:
        s2.play(0)
        apple_location = [random.randint(1, 50) * 10, random.randint(1, 30) * 10]
        apple_generation = True

    for part in snake_body:
        pygame.draw.rect(screen, (0, 255, 0), pygame.Rect(part[0], part[1], 10, 10))
        pygame.draw.rect(screen, (255, 0, 0), pygame.Rect(apple_location[0], apple_location[1], 10, 10))
    
    if snake_location[0] < 0 or snake_location[0] > WIDTH-10 or snake_location[1] < 0 or snake_location[1] > HEIGHT-10:
        game_over_rect = end_surface.get_rect()
        game_over_rect.midtop = (360, 120)
        s1.set_volume(0)
        pygame.mixer.music.load("end.mp3")
        pygame.mixer.music.play(0)
        screen.fill((0, 0, 0))
        screen.blit(end_bg, (0,0))
        pygame.display.flip()
        pygame.time.wait(3000)
        pygame.quit()
        break

    pygame.display.update()
    FPS.tick(10)
