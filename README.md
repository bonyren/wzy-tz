# 轻量级股权投资管理系统

### 系统简介

《轻量级股权投资管理系统》是一套轻量级的股权投资项目管理，基金运营软件解决方案。它面向股权投资基金公司，为其提供一系列的日常业务管理工具，让业务开展和团队协作更高效，轻松，智能。

### 测试系统演示
[http://tz.wzyer.com](http://tz.wzyer.com)

支持独立部署，详情请咨询技术支持。

### 技术支持
[wzycoding@qq.com](mailto:wzycoding@qq.com)

### 运行环境
- php 7.4
- mysql 8.0
- Apache/Nginx Web Server
 

### 部署步骤
1. 下载部署代码
2. 部署Web server, document根目录为 /public
3. 创建数据库，修改数据库配置文件，位于 /application/database.php
4. 导入数据库初始化脚本，位于 /db/db.sql
5. 以下目录设置成web服务器运行用户可读写
/runtime, /temp, /public/upload, /public/import, /public/export
5. Congratulation!, 访问系统, 默认用户名/密码 test/123456

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