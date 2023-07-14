import './bootstrap';

/*Echo.private(`private-assignent.${id}`)
.listen('TicketAssigned', (e) => {
    console.log(e.order);
});*/



Echo.private(`users.` + userId)
.notification((notification) => {
    console.log(notification.type);
    alert('New ticket assigned');
    $('#notif-dropdown').load(document.URL +  ' #notif-dropdown');
});


/*Echo.private(`users.7` )
.listen('Illuminate\Notifications\Events\BroadcastNotificationCreated', (e) => {
    console.log(e.order);
    alert(JSON.stringify(data));
});*/
/*
Echo.private(`assignement.7` )
.listen('TicketAssigned', (e) => {
    console.log(e.order);
    alert(JSON.stringify(data));
});*/