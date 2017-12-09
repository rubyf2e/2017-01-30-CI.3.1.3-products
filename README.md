這個repository 因為遺失了Share.php
所以直接clone下來是不能用的
而且也缺少了sql檔
因為本人暫時沒有時間重寫修復bug
所以大約寫一下這個後台使用的技巧

這個專案使用CI框架製作，經由首頁註冊過後，即可進入後台
在設定頁透過設置，可以在後台出現三層分類的後台編輯設定。
透過設定頁，可以直接用設定的方式定義各個分類的標題和input種類。

https://github.com/rubyf2e/2017-01-30-CI.3.1.3-products/tree/ubuntu/html/main
我將後台常用的input類型，切割成一小塊一小塊的模板
透過資料庫的存取，依照登入者的id去判斷目前會出現怎樣的後台

其中有運用到gmail的SMTP和CI自帶的SEESION驗證碼
使用bootstrap 使用CKEDITOR Dropzone.js等套件
大量使用ajax 

此作品花了我一個月的時間製作，而這是我第一次直接用CI框架製作。
在當時我的程式經驗僅有一年，還請多包涵

