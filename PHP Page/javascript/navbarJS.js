/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
  $('.js-logout').on('click', function(){
    url = window.location.href;
    window.location =  url + "/logout.php";
  });
});
