# import cv2
# img = cv2.imread("ch.jpg",-1)
# print(img.shape)
#
# # # resize函数 参数 宽在前，高在后
# # # 指定大小
# # out=cv2.resize(img,img.shape[:2])
# # print(out.shape)
# #
# # cv2.imwrite('out1.jpg',out)
#
# # 指定倍数
# # 整数
# h,w=img.shape[:2]
# out=cv2.resize(img,(w*3,h*2))
# print(out.shape)
# # 小数
# h,w=img.shape[:2]
# # out=cv2.resize(img,(w*2.5,h*3.1)) #错误写法
# out=cv2.resize(img,(int(w*2.5),int(h*3.1)))
# print(out.shape)
#
# # 指定倍数2
# out1=cv2.resize(img,None,fx=2.1,fy=4) #fx是宽 fy是高
# print(out1.shape)
#
# # 缩小0.6 0.8
# out2=cv2.resize(img,None,fx=0.8,fy=0.6) #fx是宽 fy是高
# print(out2.shape)
# cv2.imwrite('out2.jpg',out)

# 图像平移
# import cv2
# import numpy as np
# img = cv2.imread("shapes2.jpg",-1)
# h,w= img.shape[:2]
# dx=50
# dy=150
# M=np.float32([[1,0,dx],[0,1,dy]])
# out=cv2.warpAffine(img,M,(w+50,h+150)) #宽高
# cv2.imshow("s",out)
# cv2.waitKey()

# 图像翻转
import cv2
img = cv2.imread("lenna.bmp",-1)
imgout_x=cv2.flip(img,0)
imgout_y=cv2.flip(img,1)
imgout_xy=cv2.flip(img,-1)
cv2.imshow("x",imgout_x)
cv2.waitKey()
cv2.imshow("y",imgout_y)
cv2.waitKey()
cv2.imshow("xy",imgout_xy)
cv2.waitKey()
cv2.imwrite('out3.jpg',imgout_x)
cv2.imwrite('out4.jpg',imgout_y)
cv2.imwrite('out5.jpg',imgout_xy)