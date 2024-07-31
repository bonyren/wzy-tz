# 轻量级股权投资管理系统

### 系统简介

《轻量级股权投资管理系统》是一套轻量级的股权投资项目管理，基金运营软件解决方案。它面向股权投资基金公司，为其提供一系列的日常业务管理工具，让业务开展和团队协作更高效，轻松，智能。

### 运行环境
- php 7.4
- mysql/MariaDB
- Apache/Nginx Web Server
 
### 系统依赖
- thinkphp 5.0 framework

### 部署步骤
1. 部署代码
2. 部署Web server, document root为src\public
2. 导入数据库配置wzyer_daohe.sql从src\db
3. 修改数据库配置文件src\application\database.php
4. Congratulation!, 访问系统，默认登录账号admin/123456, 切记：登录后立即修改密码

### 系统组成
![轻量级股权投资管理系统功能架构](https://images.gitee.com/uploads/images/2022/0306/160915_39dfdc2a_10482337.png "轻量级股权投资管理系统功能架构.png")

### 系统截图
#### 首页
![输入图片说明](https://images.gitee.com/uploads/images/2022/0313/233947_402c89e6_10482337.jpeg "home.jpeg")
#### 投资项目管理
![输入图片说明](https://images.gitee.com/uploads/images/2022/0313/234021_9b34cfdb_10482337.jpeg "projects.jpeg")
#### 投资项目详情
![输入图片说明](https://images.gitee.com/uploads/images/2022/0313/234046_6dad75b1_10482337.jpeg "project_detail.jpeg")
#### 基金管理
![输入图片说明](https://images.gitee.com/uploads/images/2022/0313/234103_dc97637c_10482337.jpeg "funds.jpeg")
#### 投资人管理
![输入图片说明](https://images.gitee.com/uploads/images/2022/0313/234126_aedce0ff_10482337.jpeg "lps.jpeg")
#### 科学家管理
![输入图片说明](https://images.gitee.com/uploads/images/2022/0313/234144_6fc2e8be_10482337.jpeg "scients.jpeg")