# PHP留言墙程序（本地存储版）
## 简介
这是一个基于PHP的简易留言墙程序，使用本地文件存储来保存留言数据。用户可以在此程序上留下自己的留言，查看其他用户的留言。本程序适用于个人网站、社区论坛或小型社交平台，提供一个无需数据库的环境。不适用于大型网站，因为使用的是本地JSON存储。
## 功能特点
- 留言发布：用户可以发表自己的留言。
- 留言查看：展示所有用户的留言。
- 留言删除：管理员可在文件删除恶意留言。
- 无需数据库：使用本地文件存储留言数据，简化部署。
## 环境要求
注意⚠️：环境未经大量测试，搭建时使用的PHP版本为8.3
## 安装步骤
1. 将程序文件上传到您的服务器上。
2. 确保留言墙目录有读写权限，以便程序可以正常写入数据。
3. 在浏览器中访问留言墙页面，开始使用。
## 使用说明
1. 访问留言墙页面，即可查看所有留言。
2. 在留言框中输入您的留言内容，点击“提交”按钮发表留言。
## 文件结构
```
message/
│
├── index.php          // 留言墙主页面
├── messages.json      // 存储留言数据的JSON文件（留言后自动创建）
└── README.md          // 本说明文件
```
## 更新日志
- 版本1.0：发布初始版本。
- 版本1.1：优化手机端UI
- 版本1.2：修复报错的问题
## 反馈与支持
如果您在使用过程中遇到问题，请通过以下方式联系我们：
- 邮箱：[traxraria@qq.com](mailto:traxraria@qq.com)
- 提交Issues
感谢您的使用！
