import drawSvg as draw
d = draw.Drawing(300, 100, origin='center', displayInline=False)

a = draw.Circle(-85,15, 20, fill='#A0522D')
a.appendAnim(draw.Animate('cy', '4s', '-15;-10;-15;-12;-10;-14;-12;-15',
                          repeatCount='indefinite'))
d.append(a)

b = draw.Circle(-15,15, 20, fill='#A0522D')
b.appendAnim(draw.Animate('cy', '4s', '-15;-10;-15;-12;-10;-14;-12;-15',
                          repeatCount='indefinite'))
d.append(b)

c = draw.Circle(-85,15, 12, fill='#CD853F') #уши
c.appendAnim(draw.Animate('cy', '4s', '-15;-10;-15;-12;-10;-14;-12;-15',
                          repeatCount='indefinite'))
d.append(c)

e = draw.Circle(-15,15, 12, fill='#CD853F')
e.appendAnim(draw.Animate('cy', '4s', '-15;-10;-15;-12;-10;-14;-12;-15',
                          repeatCount='indefinite'))
d.append(e)

d.append(draw.Circle(-50, -10, 40, fill='#A0522D'))
#голова
d.append(draw.Circle(-63,0, 17, fill='#CD853F'))
d.append(draw.Circle(-37,0, 17, fill='#CD853F'))
d.append(draw.Circle(-60,-4, 13, fill='white'))
d.append(draw.Circle(-40,-4, 13, fill='white'))
d.append(draw.Circle(-59,-7, 9, fill='black'))
d.append(draw.Circle(-41,-7, 9, fill='black'))
d.append(draw.Circle(-56,-3, 2, fill='white'))
d.append(draw.Circle(-38,-3, 2, fill='white'))
d.append(draw.Circle(-38,-3, 2, fill='white'))
d.append(draw.Circle(-50,-20, 8, fill='#4d220e'))
d.append(draw.Circle(-48,-18, 4, fill='#59351f'))
d.append(draw.Circle(-47,-17, 2, fill='#5a3d30'))

mouth = draw.Circle(-47,-35, 5, fill='#4d220e')
mouth.appendAnim(draw.AnimateTransform('scale', '2s', '1,1;1.07,1',
                                    repeatCount='indefinite'))
d.append(mouth)

mouth2 = draw.Circle(-47,-35, 4, fill='#9b2f1f')
mouth2.appendAnim(draw.AnimateTransform('scale', '2s', '1,1;1.07,1',
                                    repeatCount='indefinite'))
d.append(mouth2)
d.setPixelScale(7)
d
