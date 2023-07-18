import './bootstrap';




Echo.private(`App.Models.Client.` + clientId)
.notification((notification) => {
    console.log(notification.type);
    //alert('Status closed');
    $('#notif-dropdown').load(document.URL +  ' #notif-dropdown');
    //document.getElementById('js-count').innerHTML = parseInt(document.getElementById('js-count').innerHTML) + 1;
});



