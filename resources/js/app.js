import './bootstrap';




Echo.private(`users.` + userId)
.notification((notification) => {
    console.log(notification.type);
   // alert('New ticket assigned');
    $('#notif-dropdown').load(document.URL +  ' #notif-dropdown');
    //document.getElementById('js-count').innerHTML = parseInt(document.getElementById('js-count').innerHTML) + 1;
});




/*
Echo.private(`assignement.` + userId)
.listen('TicketAssigned', (e) => {
    console.log(e.order);
    // alert('New ticket assigned');
    $('#notif-dropdown').load(document.URL +  ' #notif-dropdown');
});
*/