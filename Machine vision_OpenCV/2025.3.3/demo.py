# import cv2
#
# img = cv2.imread('lenna_rgb.bmp',-1)
# img2 = cv2.imread('lenna.bmp',-1)
#
# # # cv2.namedWindow('s') #创建一个窗口，可缺省
# # cv2.imshow('s',img2)
# cv2.imshow('lenna',img)
#
# # cv2.waitKey(1000) #图片等待时长
# res = cv2.waitKey() #等待用户按下按键 -1和0无限等待
# print(res) #ASCII码
#
# #按键1出现彩色图 按键2出现灰度图
# #ord chr
# if res==ord('1'):
#      cv2.imshow('lennaGray',img2)
#      cv2.waitKey()
# elif res==ord('2'):
#      cv2.imshow('lennaRGB',img)
#      cv2.waitKey()
# elif res==ord('3'):
#     cv2.imwrite('new.bmp',img) #图像保存
# # cv2.destroyWindow()

# import cv2
# img = cv2.imread('lenna_rgb.bmp',-1)
# img2 = cv2.imread('lenna_rgb.bmp',0)
# print(img)
# print(img2)

# import numpy as np
# import cv2
# # new = np.zeros((20,20),dtype=np.uint8)
# new =np.random.randint(0,256,(20,20),dtype=np.uint8)
# print(new)
# cv2.imwrite('fig1.jpg',new)
# cv2.imshow('fig1',new)
# cv2.waitKey()


# import numpy as np
# import cv2
# new = np.zeros((20,20),dtype=np.uint8)
# new[10,10]=255 #矩阵修改坐标
# new.itemset((1,3),255) #调用函数
# print(new)
# cv2.imwrite('fig3.jpg',new)
# cv2.imshow('fig3',new)
# cv2.waitKey()

# import numpy as np
# import cv2
# new = np.zeros((20,20),dtype=np.uint8)
# # new[2,:]=255
# new[:,-2]=255
# # for i in range(20):
# #     new.itemset((2,i),255) #修改行列
# print(new)
# cv2.imwrite('fig4.jpg',new)
# cv2.imshow('fig4',new)
# cv2.waitKey()

import cv2
img = cv2.imread('lenna_rgb_small.bmp',-1)
# print(img)
img[1,4]=0
img[2,4]=[0,255,255]

img[0,0,0]=0 #改（0，0） B通道
img[0,0,1]=0 #改（0，0） G通道
print(img)
cv2.imwrite('fig5.jpg',img)