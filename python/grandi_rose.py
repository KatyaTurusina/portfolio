import math
import turtle

t=turtle.Turtle()
t.speed(0)

t.pencolor('red')
distance = 300
angle = 30
count = 0.6
r = distance * math.sin(count * angle)
x = r * math.sin (angle)
y = r * math.cos(angle)

t.begin_fill()
while angle <=360:
    t.setpos(x, y)
    angle += 1
    r = distance * math.sin(count * angle)
    x = r * math.sin (angle)
    y = r * math.cos(angle)
t.end_fill()
