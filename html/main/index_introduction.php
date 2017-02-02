<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once('html/main/sidebar.php');
?>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
   <div class="clearfix"></div>
   <div class="page-title">
    <div class="title_left">
      <h3>本站介紹</h3>
    </div>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">

        <div class="col-xs-3">
          <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left">
            <li class="active">
              <a href="#tab0" data-toggle="tab" aria-expanded="true">設計概念</a>
            </li>
            <li class="">
              <a href="#tab1" data-toggle="tab" aria-expanded="true">使用說明</a>
            </li>
            <li class="">
              <a href="#tab2" data-toggle="tab" aria-expanded="false">特別介紹</a>
            </li>
            <li class="">
              <a href="#tab3" data-toggle="tab" aria-expanded="false">待續更新</a>
            </li>
            <li class="">
              <a href="#tab4" data-toggle="tab" aria-expanded="false">本站環境</a>
            </li>
          </ul>
        </div>

        <div class="col-xs-9">
          <!-- Tab panes -->
          <div class="tab-content">
            <div class="tab-pane active" id="tab0">
              <p class="lead">設計概念</p>
              <p>
                此網為使用者可以直接藉由後台的欄位新增操作建立專屬自己的後台，在製作過程中亦盡量兼顧自適應網頁的需求。
                因時間有限，故無用網站後台常用的功能製作，資料亦皆存入同一張資料表，僅用功能的方式呈現後台可以用類似的技術製作，資料表的地方亦可用填選的方式建立，在套版網站功能相似時可以用這樣的方式減少建立後台的時間。
              </p>
              <a href='<?=site_url('login_controller/sample')?>' target='_blank' style='color:#9c33ff'>使用範例</a>
            </div>
            <div class="tab-pane" id="tab1">
              <p class="lead">使用說明</p>
              <p>
                請點選下列圖示中的新建功能建立自己專屬的後台，在建立第一層後，請至視窗盒子選項建立視窗盒子，方可新增視窗盒子裡的編輯功能。
              </p>
              <div class="col-md-12 col-sm-12 col-xs-12">               
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <img src="<?=base_url('html\templates\images\nav_updown.png')?>" class="nav_updown">
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12" style='padding:1% 0 0 30%'>
                    右上角
                  </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12" style='padding-top:25%'>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                    <img src="<?=base_url('html\templates\images\nav_down.png')?>" style="width: 100%;">
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12" style='padding:1% 0 0 30%'>
                    左下角
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <br>
              <div class="col-md-12 col-sm-12 col-xs-12"> 
               <p>
                 目前後台可新增欄位類型為:
               </p>
               <ul>
                <li>text</li>
                <li>textarea</li>
                <li>radio</li>
                <li>checkbox</li>
                <li>switch</li>
                <li>morepic</li>
              </ul>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12"> 
              <p>
                在設定視窗盒子及內容時可以選擇相對應的分類，可設定為單層、雙層、三層，如同左側選單中的範例一、範例二、範例三所示。<br>
                另外在下拉選單和多圖上傳的部分使用ajax,因為主機端網速的問題，有時會延誤，敬請見諒。
              </p>
            </div>
          </div>
          <div class="tab-pane" id="tab2">
            <p class="lead">特別介紹</p>
            <p>
              textarea為使用ckeditor的編輯器，morepic為ajax多張圖片上傳。<br>
              新建後台功能中的比較特別的是下拉式選單的ajax，因為設計為後台可以有單層、雙層、三層分類的編輯頁，因此在視窗盒子的連動花了比較多心力。<br>
              其程式碼寫在<a href='<?=base_url('html\templates\css\js\custom.js')?>' style='color:#9c33ff'>custom.js</a>註解/**ajax相關函式**/以下的地方，用遞迴函數的方式撰寫。<br>
              本站原始碼:<a href='https://github.com/joy511437/2017-01-30-CI.3.1.3-products' style='color:#9c33ff'>https://github.com/joy511437/2017-01-30-CI.3.1.3-products</a>
            </p>
          </div>
          <div class="tab-pane" id="tab3">
           <p class="lead">待續更新</p>
           <p>
             因為時間有限，故編輯設定的功能尚未製作，
             未來會將編輯設定的功能新增ajax拖曳排序的功能以及將下拉式選單的ajax
             以先行呼叫相關參數再進行ajax，減少ajax呼叫資料庫的次數，增加網站效能。
             日後若有時間，會逐漸刻出基本網站常用的後台格式及功能，並分為後台使用者及工程師專用後台建立帳號。
             因為想製作Laravel和CodeIgniter雙框架版本，因此先將CI部分先告一段落，把時間挪於製作Laravel框架版本增加自己的實力。
           </p>
         </div>
         <div class="tab-pane" id="tab4">
           <p class="lead">本站環境</p>
           <div class="col-md-12 col-sm-12 col-xs-12"> 
             <h4>php 框架</h4>
             <p>CodeIgniter-3.1.3</p>
           </div>
           <div class="col-md-12 col-sm-12 col-xs-12"> 
             <h4>html 框架</h4>
             <p>Bootstrap </p>
           </div>
           <div class="col-md-12 col-sm-12 col-xs-12"> 
             <h4>環境</h4>
             <p>php    7.0.8, <br>
               ubuntu 16.04.3</p>
             </div>
           </div>
         </div>
       </div>

       <div class="clearfix"></div>

     </div>
   </div>
 </div>

 <div class="clearfix"></div>

</div>
</div>

<!-- /page content -->

<!-- footer content -->
<footer>


  <div class="pull-right">
    DESIGNED BY Chen Wei Hsu, Gentelella - Bootstrap Admin Template by Colorlib
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
</div>
</div>