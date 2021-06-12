<?php
/* Smarty version 3.1.39, created on 2021-06-12 22:26:53
  from '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/admin-table-management.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_60c5188d77b163_63979209',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50f998db01c83d157ceb6f1dd1097d7973c75708' => 
    array (
      0 => '/mnt/14BC98A7696799CA/FOI/FOI Materijali/6. semestar/Web dizajn i programiranje/Projekt/templates/admin-table-management.tpl',
      1 => 1623529612,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60c5188d77b163_63979209 (Smarty_Internal_Template $_smarty_tpl) {
?><div style="margin-top: 100px;"></div>
<section class="section__admin-controls__table-controls">
    <table>
        <caption id="table-caption"></caption>
        <thead id="table-header"></thead>
        <tbody id="table-body"></tbody>
    </table>
</section>
<div class="paging-log">
    <p class="paging-info"></p>
    <div class="paging-log-controls">
        <button id="first-log">Prva stranica</button>
        <button id="back-log">⏮️</button>
        <progress id="progress-log">
            currentPage/maxPage
        </progress>
        <button id="next-log">⏭️</button>
        <button id="last-log">Zadnja stranica</button>
    </div>
</div>
<nav id="admin_control_panel" style="left: auto; right: 0">
    <ul id="table-list"></ul>
</nav><?php }
}
