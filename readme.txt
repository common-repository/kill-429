=== Kill 429 -完美解决WordPress 429 Too Many Requests报错 ===
Contributors: wbolt,mrkwong
Donate link: https://www.wbolt.com/
Tags: 429 Too Many Requests, 429报错, WordPress 429, 状态码429
Requires at least: 4.8
Tested up to: 5.3
Stable tag: 1.1.0
License: GNU General Public License v2.0 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

2019年年底只要是部署在中国境内的服务器的WordPress网站，后台执行WordPress版本更新，或者WordPress主题、WordPress插件更新时，就会提示429 Too Many Requests，原因暂不明确。WordPress 429报错状态码到目前为止依然存在，不少站长对这种情况无可奈可，又或者只能先通过其他途径先下载WordPress安装包、主题及插件压缩包，再上传到服务器安装。
但这种方式对于大部分站长来说，流程繁琐。因此，闪电博为了帮助各站长解决此问题，特地开发了Kill 429（完美解决Too Many Requests报错）这款插件，安装并激活该插件后，中国境内服务器上的Wordpress可以直接升级版本及更新主题、插件。


== Description ==

Kill 429是一款解决中国境内服务器WordPress版本更新，主题及插件更新报429错误的插件，插件通过优化中国境内服务器访问WordPress数据服务器的网络，解决429报错问题，快速安装WordPress版本更新及其他主题、插件更新。

Kill 429插件提供”传统代理“和”Nginx反向代理+CDN“两种模式，连接WordPress官方服务器，以解决国内服务器直连WordPress服务器时，提示429 Too Many Requests而无法正常更新WordPress及WordPress官方市场主题、插件。其中：

* **传统代理模式**-该模式提供为站长自主配置，需要站长自行填入代理服务器IP、端口。此种模式需要站长拥有一个稳定的代理服务器IP地址；
* **CDN模式+Nginx反向代理**-提供日本、美国及香港三个服务器节点，通过CDN缓存+Nginx反向代理组合，解决国内服务器无法请求WordPress服务器的问题。

Kill 429工作原理：
 **Step 1**-国内服务器发起WordPress更新请求（包括WordPreen版本更新、官方市场主题及插件安装或者更新）；
 **Step 2**-CDN服务器判断请求数据版本，若有云存储存在缓存版本直接更新安装；若无，则连接Nginx反向代理服务器请求WordPress官方服务器版本缓存至CDN云服务器再更新安装。

== Installation ==

FTP安装
1. 解压插件压缩包kill-429.zip，将解压获得文件夹上传至wordpress安装目录下的 `/wp-content/plugins/`目录.
2. 访问WordPress仪表盘，进入“插件”-“已安装插件”，在插件列表中找到“Kiil 429”，点击“启用”.
3. 通过“设置”->“Kill 429设置” 进入插件设置界面即可.

仪表盘安装
1. 进入WordPress仪表盘，点击“插件-安装插件”：
* 关键词搜索“Kill 429”，找搜索结果中找到“Kill 429”插件，点击“现在安装”；
* 或者点击“上传插件”-选择“Kill 429”插件压缩包kill-429.zip，点击“现在安装”。
2. 安装完毕后，启用“Kill 429”插件.
3. 通过“设置”->“杀死429报错” 进入插件设置界面.

关于本插件，你可以通过阅读<a href="https://www.wbolt.com/kill-429-plugin-documentation.html?utm_source=wp&utm_medium=link&utm_campaign=kill-429" rel="friend" title="插件教程">Kill 429插件教程</a>学习了解插件安装、设置等详细内容。

== Frequently Asked Questions ==

= 为什么选择服务器节点更新WordPress及主题插件时，还是提示429 Too Many Requests？ =

如果遇到这种情况，可能由于当前服务器节点在线人数过多导致请求失败。可以通过切换服务器节点重新更新，或者稍后再试。

= 能否增加更多的服务器节点？ =

目前日本、美国及香港的服务器节点，还有国内CDN及云存储服务器，均由闪电博维护。每年的费用不低，未来视实际情况再考虑是否新增服务器节点。

= 为什么更新WordPress版本及更新主题插件速度还是比较慢？ =

当国内云存储服务器没有该更新的缓存数据时，需要CDN服务器请求境外服务器节点请求更新，缓存至国内云存储服务器，需要一定的时间。


== Notes ==

Kill 429是一款专门为WordPress开发的<a href="https://www.wbolt.com/plugins/kill-429?utm_source=wp&utm_medium=link&utm_campaign=kill-429" rel="friend" title="Kill 429插件">解决WordPress 429报错问题的插件</a>. 插件通过优化中国境内服务器访问WordPress数据服务器的网络，解决429报错问题，快速安装WordPress版本更新及其他主题、插件更新。

闪电博（<a href="https://www.wbolt.com/?utm_source=wp&utm_medium=link&utm_campaign=kill-429" rel="friend" title="闪电博官网">wbolt.com</a>）专注于WordPress主题和插件开发,为中文博客提供更多优质和符合国内需求的主题和插件。此外我们也会分享WordPress相关技巧和教程。

除了Kill 429插件外，目前我们还开发了以下WordPress插件：

- [百度搜索推送管理-历史下载安装数30,000+](https://wordpress.org/plugins/baidu-submit-link/)
- [热门关键词推荐插件-最佳关键词布局插件](https://wordpress.org/plugins/smart-keywords-tool/)
- [Smart SEO Tool-高效便捷的WP搜索引擎优化插件](https://wordpress.org/plugins/smart-seo-tool/)
- [IMGspider-轻量外链图片采集插件](https://wordpress.org/plugins/imgspider/)
- [博客社交分享组件-打赏/点赞/微海报/社交分享四合一](https://wordpress.org/plugins/donate-with-qrcode/)
- [清理HTML代码标签-一键清洗转载文章多余代码](https://wordpress.org/plugins/clear-html-tags/)

- 更多主题和插件，请访问<a href="https://www.wbolt.com/?utm_source=wp&utm_medium=link&utm_campaign=kill-429" rel="friend" title="闪电博官网">wbolt.com</a>!

如果你在WordPress主题和插件上有更多的需求，也希望您可以向我们提出意见建议，我们将会记录下来并根据实际情况，推出更多符合大家需求的主题和插件。

致谢！

闪电博团队

== Screenshots ==

1. Kill 429插件设置页面截图.

== Changelog ==

= 1.1.0 =
* 新增CDN模式+NG反向代理，提升连接WordPress服务器成功率；
* 新增服务器节点，提供日本、美国和香港三个服务器节点；
* 取消官方默认传统代理服务器模式，仅保存站长自定义代理服务器模式。

= 1.0.0 =
* 新增WordPress数据服务器请求服务器线路
* 解决中国境内服务器请求WordPress服务器报429错误
* 支持配置第三方代理IP地址

