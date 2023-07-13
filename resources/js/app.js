import './bootstrap';


Echo.private('App.Models.User.' + userId)
.notification((notification) => {
    console.log(notification.type);
});