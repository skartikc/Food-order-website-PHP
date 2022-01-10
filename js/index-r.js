function rEditPrice(id){
    newp = prompt("Enter the new price");
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        console.log(this.responseText);
    }
    xhr.open("POST", "../scripts/editprice-r.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    xhr.send("id=" + id + "&np=" + newp);
    location.reload();
}
function rEditName(id){
    newp = prompt("Enter the new name for the item");
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        console.log(this.responseText);
    }
    xhr.open("POST", "../scripts/editname-r.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    xhr.send("id=" + id + "&nn=" + newp);
    location.reload();
}
function rEditVegStat(id){
    newp = confirm("Click YES for veg, CANCEL for non-veg");
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        console.log(this.responseText);
    }
    xhr.open("POST", "../scripts/editvegstat-r.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    xhr.send("id=" + id + "&vs=" + newp);
}
function rDeleteItem(id){
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        console.log(this.responseText);
    }
    xhr.open("POST", "../scripts/deleteitem-r.php");
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    xhr.send("id=" + id);
    location.reload();
}