# gulosity
基于Laravel4 开发的移动点餐系统，支持微信或者作为独立的wap站点。
（目前支持微信公众号作为入口的功能，包括下单、微信支付、后台订单管理等等）

###Usage
---
1. clone gulosity到你的服务器

	```
	cd www #服务器放网站目录
	git clone https://github.com/liangqikang/gulosity.git
	```

1. 切换到`composer.json`所在目录，使用composer安装项目

	> 如果没有安装过composer请先安装：<br>
 	linux/OSX: [https://getcomposer.org/doc/00-intro.md#installation-nix](https://getcomposer.org/doc/00-intro.md#installation-nix)<br>
 	windows: [https://getcomposer.org/doc/00-intro.md#installation-windows](https://getcomposer.org/doc/00-intro.md#installation-windows)

	```
	cd www/gulosity
	composer install
	```

1. 修改`bootstrap/start.php`中`27`行的环境配置，里面有说明。
1. 创建mysql数据库创建账号密码，将`gulosity.sql`导入数据库。
1. 修改数据库配置`app/config/database.php`，如果你没改上面的start.php中的环境部分的话请修改`app/config/production/database.php`。
1. 修改`app/storage/` 目录权限为可写,*nix下 执行：

    ```
    sudo chmod -R 755 app/storage/
    ```
    
1. apache配置如下：apache httpd.conf:
  	```
    <VirtualHost *:80>
            ServerName xxx.com
            DocumentRoot /var/www/gulosity/public
    
           <Directory /var/www/gulosity/public>
              <IfModule mod_rewrite.c>
              Options -MultiViews
              RewriteEngine On
              RewriteCond %{REQUEST_FILENAME} !-f
             RewriteRule ^ index.php [L]
           </IfModule>
    </Directory>
    </VirtualHost>
  	```

1. 那么现在访问`http://xxx.com` 应该会访问首页页，`http://xxx.com/admin` 访问后台管理页。

###友情提示
---
- 因为本项目还在持续开发中，如果你想跟进开发进度请点击右上角的`watch`以便于收到更新邮件通知。
- 如果你的网络慢，使用composer install老半天没反应，你可以直接拷其它laravel项目的vendor目录放到本目录就好。
然后再执行一下：`composer dumpautoload`，如果运行不起来，试试`composer install`。:smiley:

> 当然别忘记点上面的 star 哦! :stuck_out_tongue_winking_eye:

####感谢支持！
