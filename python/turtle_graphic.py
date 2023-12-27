import turtle
import time

t = turtle.Turtle()
t.pencolor("#CD5C5C")
turtle.bgcolor("black")
t.speed(0)

def spiral():
    for i in range(360):
        t.forward(i * 4)
        t.right(122)

def spin(d):
    t.penup()
    t.home()
    t.left(d * n)
    t.down()

try:
    n = 0
    while True:
        turtle.tracer(0)
        t.clear()
        spin(-5)
        spiral()
        n += 1
        turtle.update()
        time.sleep(0.02)
except:
    print("Exit")
