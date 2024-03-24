var base  = location.protocol+'//'+location.host;
var route = document.getElementsByName('routeName')[0].getAttribute('content');
var slider = new slider;

document.addEventListener('DOMContentLoaded', function(){
    var form_avatar_change = document.getElementById('form_avatar_change');
    var btn_avatar_edit = document.getElementById( 'btn_avatar_edit');
    var avatar_change_overlay = document.getElementById( "avatar_change_overlay");
    var input_file_avatar = document.getElementById( 'input_file_avatar');
    var product_list = document.getElementById('products_list');
    if(btn_avatar_edit){
        btn_avatar_edit.addEventlistener('click', function(e){
           e.preventDefault();
            input_file_avatar.click();
        })



    }
    if(input_file_avatar){
        input_file_avatar.addEventListener('change', function(){
        var load_img;
           avatar_change_overlay.innerHTML = load_img;
           avatar_change_overlay.style.display =flex;
            form_avatar_change.submit();
        })
    }

    if(route == "home"){
        load_products('home');
    }
});

function load_products(section){
    var url =  base + '/md/api/load/products/' + section;
    console.log(url);                             
    http.open('GET', url, true);
    http.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    http.send();
    http. onreadystatechange = function(){
        if(this. readyState == 4 && this. status == 200){
            var data = this. responseText;
            data = JSON. parse (data);
            data.data.array.forEach(function(element, index){
               var div;
               div += "<div class=\"product\">";
               div += "<div class=\"title\">"+product.name+"</div>";
               div += "<div>";
               product_list.innerHTML += div;


                
            });
        }else{
            // Mensaje de error

    }
}
}