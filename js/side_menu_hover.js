$(document).ready(function(){
    //POSICIONANDO AS DESCRIÇÕES

    var i = 0;
    var menuItems = document.getElementsByClassName('menu-item-mask');

    var arr = [];
    while(i < menuItems.length)
    {
        var children = menuItems[i].children;
        var c = 0;

        while(c < children.length)
        {
            if(children[c].className == "menu-item")
            {
                //TODO: os elementos de descrição são posicionados de maneira que fiquem ligeiramente visíveis
                var width   = children[c].offsetWidth;
                var height  = children[c].offsetHeight;
                var centerX = children[c].offsetLeft + (width/2);
                var centerY = children[c].offsetTop  + (height/2);


                var itemDesc = children[c].nextElementSibling;
                itemDesc.style.top = (centerY - itemDesc.offsetHeight/2)+"px";

                var menuWidth = document.getElementById("side-menu").offsetWidth;
                var excess = (menuWidth - itemDesc.offsetWidth);
                var leftPush = excess + 9;

                itemDesc.setAttribute('leftPush', leftPush);
                itemDesc.style.zIndex = "2";
                itemDesc.style.left =  leftPush+"px";
                arr.push(children[c].id+"_"+itemDesc.id);
            }
            c++;
        }
        i++;
    }
});
    /*
    i = 0;
    while(i < arr.length)
    {
        var button = document.getElementById(arr[i].split('_')[0]);

        button.addEventListener('mouseover', function(event){
            var sib = event.target.nextElementSibling;
            sib.style.left = "40px";
            event.target.style.cursor = "pointer";
            event.target.children[0].style.color = "#42A0EB";
        }, false);

        button.addEventListener('mouseout', function(event){
            var sibWidth = event.target.nextElementSibling.offsetWidth;
            var menuWidth = document.getElementById("side-menu").offsetWidth;
            var left = (menuWidth - sibWidth)+10;

            event.target.style.backgroundColor = "transparent";
            event.target.nextElementSibling.style.left = left+"px";
            event.target.children[0].style.color = "white";
        }, false);
        /*
        buttonIcon.addEventListener('mouseover', function(event){
            var sib = event.target.nextElementSibling;
            sib.style.left = "40px";
            event.target.style.cursor = "pointer";
            event.target.children[0].style.color = "#42A0EB";
        }, false);

        buttonIcon.addEventListener('mouseout', function(event){
            var sibWidth = event.target.nextElementSibling.offsetWidth;
            var menuWidth = document.getElementById("side-menu").offsetWidth;
            var left = (menuWidth - sibWidth)+10;

            event.target.style.backgroundColor = "transparent";
            event.target.nextElementSibling.style.left = left+"px";
            event.target.children[0].style.color = "white";
        }, false);
        i++;
    }

    i = 0;
    var buttonIcons = document.getElementsByClassName("menu-item");

    while( i < buttonIcons.length )
    {
        buttonIcons[i].childNodes[0].addEventListener('mouseover', function(event){
            var sib = event.target.parentNode.nextElementSibling;

            sib.style.left = "40px";
            event.target.style.cursor = "pointer";
            event.target.style.color = "#42A0EB";
        }, false);

        buttonIcons[i].childNodes[0].addEventListener('mouseleave', function(event){
            var sibWidth = event.target.nextElementSibling.offsetWidth;
            var menuWidth = document.getElementById("side-menu").offsetWidth;
            var left = (menuWidth - sibWidth)+10;

            event.target.style.backgroundColor = "transparent";
            event.target.nextElementSibling.style.left = left+"px";
            event.target.children[0].style.color = "white";
        }, false);
        i++;
    }
};*/
