這個repository 因為遺失了Share.php<br>
所以直接clone下來是不能用的<br>
而且也缺少了sql檔<br>
因為本人暫時沒有時間重寫修復bug<br>
所以大約寫一下這個後台使用的技巧<br>

這個專案使用CI框架製作，經由首頁註冊過後，即可進入後台<br>
在設定頁透過設置，可以在後台出現三層分類的後台編輯設定。<br>
透過設定頁，可以直接用設定的方式定義各個分類的標題和input種類。<br>
另外也有埋log塞進資料庫，可以紀錄使用者的操作行為<br>

https://github.com/rubyf2e/2017-01-30-CI.3.1.3-products/tree/ubuntu/html/main<br>
我將後台常用的input類型，切割成一小塊一小塊的模板<br>
透過資料庫的存取，依照登入者的id去判斷目前會出現怎樣的後台<br>

其中有運用到gmail的SMTP和CI自帶的SEESION驗證碼<br>
使用bootstrap 使用CKEDITOR Dropzone.js等套件<br>
大量使用ajax <br>

此作品花了我一個月的時間製作，而這是我第一次直接用CI框架製作。<br>
在當時我的程式經驗僅有一年，還請多包涵<br>

