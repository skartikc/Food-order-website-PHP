// var resArr;
if(document.getElementById('set-cart').getAttribute('data-logstat')=="1"){
    var mycartStr = document.getElementById('set-cart').getAttribute('data-cart');
    console.log("1. mycartstr is " + mycartStr);
    mycartStr = JSON.parse(mycartStr);
}

window.onbeforeunload = function(){
    if(document.getElementsByClassName('fitem-single') || document.getElementsByClassName('food-menu-add'))
        myfun();
};

// generic functions
function setCharAt(str,index,chr){
    if(index > str.length-1) return str;
    return str.substring(0,index) + chr + str.substring(index+1);
}
function myfun(){
    console.log("myfun");
    var tempcartstr = mycartStr;
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        console.log(this.responseText);
    }
    xhr.open("POST", "scripts/cartdb.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    xhr.send("mycart=" + JSON.stringify(tempcartstr));
}
function createCookie(name, value, days){
    var expires;
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toGMTString();
    }
    else 
      expires = "";
    document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
}
function alrtCls(){
    let para = document.getElementsByClassName('alrt');
    for(let i=0;i<para.length;i++)
    if(para[i].style.display != 'none'){
        para[i].style.display = 'none';
    }
}
// user profile page
function hideOrders(){
    let x = document.getElementById('edit-prof');
    let y = document.getElementById('ord-prof');
    y.style.visibility = 'hidden';
    x.style.visibility = 'initial';
}
function hideProfile(){
    let x = document.getElementById('ord-prof');
    let y = document.getElementById('edit-prof');
    y.style.visibility = 'hidden';
    x.style.visibility = 'initial';
}
//explore page
function getLoc(){
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else 
        { 
          alert("Geolocation is not supported by this browser.");
        }
}
function showPosition(position){
    alert("Latitude: " + position.coords.latitude + " Longitude: " + position.coords.longitude);
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        console.log(this.responseText);
        resList = this.responseText;
        resArr = JSON.parse(resList);
        if(resArr.length != 0)
            {
                x = document.getElementById('nearme');
                i=0;
                for(res in resArr){
                    x.children[i].style.display = 'flex';
                    x.children[i].children[0].innerHTML=resArr[res];
                    i++;
                }
            }
    }
    xhr.open("POST", "scripts/nearme.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    xhr.send("lat=" + position.coords.latitude + "&lon=" + position.coords.longitude);
    
}
// alerts
function fadeIn(){
    let para = document.getElementsByClassName('alrt');
    for(let i=0;i<para.length;i++)
    para[i].style.display = 'none';
}
setTimeout(fadeIn, 9900);
function alertLogin()
{
    alert("Login to views these Offers");
}
function alertCart()
{
    alert("Whoops ! Your Cart is Empty, Add items to view your cart.");
}

// explore page carousel
function caroClickL(element){
    parenT = element.parentNode;
    parenT = parenT.parentNode;
    cell1 = parenT.children[0];
    cell2 = parenT.children[2];
    cell3 = parenT.children[4];
    [cell1.innerHTML, cell2.innerHTML, cell3.innerHTML] = [cell3.innerHTML, cell1.innerHTML, cell2.innerHTML]
}
function caroClickR(element){
    parenT = element.parentNode;
    parenT = parenT.parentNode;
    cell1 = parenT.children[0];
    cell2 = parenT.children[2];
    cell3 = parenT.children[4];
    [cell1.innerHTML, cell2.innerHTML, cell3.innerHTML] = [cell2.innerHTML, cell3.innerHTML, cell1.innerHTML]
}

// cart functions
function orderClick(total){
    console.log("orderClick()");
    if(document.getElementById('pymt-mthd').children[0].checked == true)
        pymtopt = 1;
    else 
        pymtopt = 0;
    var tempcartstr = mycartStr;
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        console.log(this.responseText);
    }
    xhr.open("POST", "scripts/orderdb.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    xhr.send("mycart=" + JSON.stringify(tempcartstr) + "&total=" + total + "&pymtopt=" + pymtopt);
    mycartStr = [];
    window.location.href = "index.php";
}


function checkRadio(element){
    if(element==element.parentNode.children[1])
        element.parentNode.children[0].checked = true;
    else 
        element.parentNode.children[2].checked = true;
}

function chk_cart_items(arrstr,fid){
    for(i=0;i<arrstr.length;i++)
    {
        
        fidStr = arrstr[i][0] + arrstr[i][1];
        fidInt = parseInt(fidStr);
        if(fidInt==fid)
        {
            num = arrstr[i][((arrstr[i].length)-1)];
            chk=1;
            return num;
        }
    }
    return -1;
}

function calc_cart_items(arrstr,fid,num){
    chk=0;
    for(i=0;i<arrstr.length;i++)
    {
        fidStr = arrstr[i][0] + arrstr[i][1];
        fidInt = parseInt(fidStr);
        if(fidInt==fid)
        {
            arrstr[i] = setCharAt(arrstr[i], ((arrstr[i].length)-1),num);
            chk=1;
            break;
        }
    }
    if(chk == 0)
    {
        arrstr[arrstr.length] = fid + " " + num;
    }
    return arrstr;
}

function LTOplus(currentElement, fid){
    parentDiv = currentElement.parentNode;
    str = parentDiv.children[1].innerHTML;
    num = parseInt(str);
    if(num < 9)
    {
        num++;
        mycartStr = calc_cart_items(mycartStr, fid, num);
        parentDiv.children[1].innerHTML = num;
        console.log("NEW str =" + mycartStr);
    }
    if(document.getElementById('set-cart').getAttribute('data-page')=='mycart')
    {
        location.reload();
    }
}

function LTOminus(currentElement, fid){
    parentDiv = currentElement.parentNode;
    str = parentDiv.children[1].innerHTML;
    num = parseInt(str);
    if(num != 1)
    {
        num--;
        mycartStr = calc_cart_items(mycartStr, fid, num);
        console.log("NEW str =" + mycartStr);
    }
    else 
    {
        if(document.getElementById('set-cart').getAttribute('data-page')=='mycart')
        {
            parentDiv = parentDiv.parentNode;
            parentDiv = parentDiv.parentNode;
            parentDiv = parentDiv.parentNode;
            parentDiv.style.display = 'none';
            console.log(document.getElementsByClassName('fitem-single'));
        }
        else
            parentDiv.style.visibility='hidden';
        for(i=0;i<mycartStr.length;i++){
            if((mycartStr[i][0] + mycartStr[i][1]).trim() == fid)
            {
                pos = i;
            }
        }
        mycartStr.splice(pos,1);
        console.log("NEW str =" + mycartStr);
    }
        parentDiv.children[1].innerHTML = num;
    if(document.getElementById('set-cart').getAttribute('data-page')=='mycart')
    {
        location.reload();
    }
}

function AddCartClick(i,fid,chk){
    AddBtn = document.getElementById("ATCBTN"+i);
    parentDiv = AddBtn.parentNode;
    maiN = parentDiv.nextElementSibling;
        num = chk_cart_items(mycartStr, fid);
        console.log("chk = " + chk);
        if(num == -1 && chk == 1)
        {
            mycartStr = calc_cart_items(mycartStr,fid,1);
            console.log("new str = " + mycartStr);
            maiN.children[1].innerHTML = '1';
            maiN.style.visibility = 'initial';
        }
        else if(chk == 0 && mycartStr[0] == null)
        {
            mycartStr = calc_cart_items(mycartStr,fid,1);
            console.log("new str = " + mycartStr);
            maiN.children[1].innerHTML = '1';
            maiN.style.visibility = 'initial';
            location.reload();
        }
        else if(chk == 0)
            {
                alert("You cart can contain food items from only 1 restaurant at a time.")
            }
    }

function AddCartPre(i,fid){
    if(document.getElementById('set-cart').getAttribute('data-logstat')=="1")
    {
        AddBtn = document.getElementById("ATCBTN"+i);
        parentDiv = AddBtn.parentNode;
        maiN = parentDiv.nextElementSibling;
        num = chk_cart_items(mycartStr, fid);
        if(num != -1)
        {
            maiN.style.visibility = 'initial';
            maiN.children[1].innerHTML = num;
        }
    }      
}
