# import cv2
# import numpy as np
# img=cv2.imread("lenna.bmp",-1)
# h,w=img.shape[:]
# M= np.float32([[-1,0,w-1],[0,1,0]]) # 理论上 w+1
# out=cv2.warpAffine(img,M,(w,h))
# # y轴镜像
# cv2.imwrite("1.jpg",out)

# import cv2
# import numpy as np
# img=cv2.imread("lenna.bmp",-1)
# h,w=img.shape[:]
# M= np.float32([[1,0,0],[0,-1,h-1]])
# out=cv2.warpAffine(img,M,(w,h))
# # x轴镜像
# cv2.imwrite("2.jpg",out)

# import cv2
# import numpy as np
# img=cv2.imread("lenna.bmp",-1)
# h,w=img.shape[:]
# M= np.float32([[-1,0,w-1],[0,-1,h-1]])
# out=cv2.warpAffine(img,M,(w,h))
# # xy轴翻转
# cv2.imwrite("3.jpg",out)

# 错切
# import cv2
# import numpy as np
# img=cv2.imread("lenna.bmp",-1)
# h,w=img.shape[:]
# dx=0.1
# dy=0
# M= np.float32([[1,dx,0],[dy,1,0]])
# out=cv2.warpAffine(img,M,(w+50,h))
# cv2.imwrite("4.jpg",out)

# import cv2
# import numpy as np
# img=cv2.imread("lenna.bmp",-1)
# h,w=img.shape[:]
# dx=0
# dy=0.2
# M= np.float32([[1,dx,0],[dy,1,0]])
# out=cv2.warpAffine(img,M,(w,h+100))
# cv2.imwrite("5.jpg",out)

# import cv2
# import numpy as np
# img=cv2.imread("lenna.bmp",-1)
# h,w=img.shape[:]
# dx=0.2
# dy=0.2
# M= np.float32([[1,dx,0],[dy,1,0]])
# out=cv2.warpAffine(img,M,(w+100,h+100))
# cv2.imwrite("6.jpg",out)
print("🐧")

# 图像旋转
# import cv2
# img=cv2.imread("lenna.bmp",-1)
# h,w=img.shape[:]
# M= cv2.getRotationMatrix2D((w/2,h/2),45,0.7)# 控制缩放比例
# out=cv2.warpAffine(img,M,(w,h),cv2.INTER_NEAREST)# 插值方法
# cv2.imshow("s",out)
# cv2.waitKey()

# 仿射变换
# import cv2
# import numpy as np
# img=cv2.imread("lenna.bmp",-1)
# h,w=img.shape[:]
# p1=np.float32([[0,0],[w-1,0],[0,h-1]])
# p2=np.float32([[0,0.5*h],[0.5*w,0],[0.5*w,0.8*h]])
# M=cv2.getAffineTransform(p1,p2)
# out=cv2.warpAffine(img,M,(w,h),cv2.INTER_NEAREST)
# cv2.imshow("s",out)
# cv2.waitKey()

# 透视
import cv2
import numpy as np
img=cv2.imread("code2d.png",-1)
h,w=img.shape[:]
p1=np.float32([[93,132],[274,68],[289,289],[94,289]])
p2=np.float32([[83,66],[289,66],[289,289],[94,289]])

M=cv2.getPerspectiveTransform(p1,p2)
out=cv2.warpPerspective(img,M,(w,h))
cv2.imshow("s",out)
cv2.waitKey()