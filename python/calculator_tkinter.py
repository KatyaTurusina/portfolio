from tkinter import *

def Click():
    try:
        answer.configure(text=str(float(num_1.get()) + float(num_2.get())), fg="black")
    except ValueError:
        answer.configure(text="Введите число!", fg="red")
    num_1.delete(0, last=len(num_1.get()))
    num_2.delete(0, last=len(num_2.get()))

window = Tk()
window.title('summa')
window.geometry('500x300')

lbl = Label(window, text="Введите слагаемые", font="Arial 16", pady=20)
lbl.pack()

first = Label(window, text="Первое",bg = "#FFE773", font="Arial 14")
first.place(relx=0.18, rely=0.27)

second = Label(window, text="Второе",bg = "#FFE773", font="Arial 14")
second.place(relx=0.68, rely=0.27)

plus = Label(window, text="+", font="Arial 22")
plus.place(relx=0.48, rely=0.38)

num_1 = Entry(window, font="Arial 14")
num_1.place(relx=0.1, rely=0.4, relwidth=0.3)

num_2 = Entry(window, font="Arial 14")
num_2.place(relx=0.6, rely=0.4, relwidth=0.3)

button = Button(window, text="Ответ",bg = "#80EA69", font="Arial 14", command=Click)
button.place(relx=0.4, rely=0.58, relwidth=0.2, relheight=0.13)

answer = Label(window, text='', font="Arial 16", pady=28)
answer.pack(side='bottom')

window.mainloop()
