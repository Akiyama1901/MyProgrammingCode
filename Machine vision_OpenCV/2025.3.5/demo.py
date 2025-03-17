import cv2
import numpy as np

# img = np.zeros((30,30,3),dtype=np.uint8)
# img[0:10,:,0]=255 # 所有行 0-9列 1通道
# img[10:20,:,1]=255
# img[20:30,:,2]=255
# cv2.imwrite('f1.jpg',img)

# import cv2
# import numpy as np
# img =np.random.randint(0,256,(30,30,3),dtype=np.uint8)
# cv2.imwrite('f2.jpg',img)

# import cv2
# img1=cv2.imread('shapes.jpg',-1)
# img2=cv2.imread('shapes2.jpg',-1)
# print(img1.shape)   # 图像大小与通道
# print(img1.shape[:2])   # 图像大小
# print(img2.shape)
#
# print(img1.size)    # 获取像素点总数
# print(img2.size)
#
# print(img1.dtype)
# print(img2.dtype)

# 前景 背景 区域
# ROI = img[行范围，列范围]
# import cv2
# img2 = cv2.imread('shapes2.jpg',-1)
#
# ROI = img2[88:233,300:400]
# cv2.imwrite('triangle.jpg',ROI)
#
# ROI = img2[200:300,160:300]
# cv2.imwrite('rectangle.jpg',ROI)

# # 区域提取
# import cv2
# img = cv2.imread('shapes.jpg',-1)
# # 1创建全黑图
# rect = np.zeros(img.shape[:2],dtype=np.uint8)
# # 2在黑色图绘制实心矩形框 得到掩膜（mask)
# # 图像 列前行后 左上右下 填充像素值 填充模式 -1实心 正数粗细
# cv2.rectangle(rect,(138,24),(278,151),255,-1)
#
# # 3mask与原图进行与
# res = cv2.bitwise_and(img,img,mask=rect)
#
# cv2.imshow("show1",res)
# cv2.waitKey()
#
# rect = np.zeros(img.shape[:2],dtype=np.uint8)
# cv2.rectangle(rect,(286,84),(400,220),255,-1)
#
# # 3mask与原图进行与
# res = cv2.bitwise_and(img,img,mask=rect)
#
# cv2.imshow("show1",res)
# cv2.waitKey()

import cv2
img = cv2.imread('shapes.jpg',-1)
# 1创建全黑图
rect = np.zeros(img.shape[:2],dtype=np.uint8)
# 2在黑色图绘制 得到掩膜（mask)
cv2.circle(rect,(204,80),255-204,255,-1)

# 3mask与原图进行与
res = cv2.bitwise_and(img,img,mask=rect)
cv2.imshow("show1",res)
cv2.waitKey()