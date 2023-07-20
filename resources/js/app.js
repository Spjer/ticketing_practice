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

const messages_el2 = document.getElementById("messages");
const message_input2 = document.getElementById("message_input");
const message_form2 = document.getElementById("message_form2");
const reciever = document.getElementById('reciever_id');
const username_el = document.getElementById('username');
const sender = userId;

console.log(reciever);
if(message_form2){
    message_form2.addEventListener('submit', function (e) {
        e.preventDefault();
        let has_errors = false;

        
        if(message_input2.value == ''){
            alert("Please enter a message");
            has_errors = true;
        } 
        if(has_errors){
            return;
        }

        const options = {
            method: 'post',
            url:'store',
            data: {
                body: message_input2.value,
                reciever_id: reciever.value,
                username: username_el.value,
                sender_id: sender,
            }
        }
        //$('#message_input').load(document.URL +  ' #message_input');

        axios(options);

    })
    window.Echo.private('private-chat.' + userId)
        .listen('.private-message', (e) => {
        //alert('amogus');
            //console.log(e);
        $('#private-messages').load(document.URL +  ' #private-messages');

    });
}






const messages_el = document.getElementById("messages");
const message_input = document.getElementById("message_input");
const message_form = document.getElementById("message_form");

if(message_form){
    message_form.addEventListener('submit', function (e) {
        e.preventDefault();
        let has_errors = false;

        
        if(message_input.value == ''){
            alert("Please enter a message");
            has_errors = true;
        } 
        if(has_errors){
            return;
        }

        const options = {
            method: 'post',
            url:'chats/send-message',
            data: {
                message: message_input.value
            }
        }
        axios(options);
    })

    window.Echo.channel('chat')
        .listen('.message', (e) => {
        messages_el.innerHTML += '<div class="message"><strong>' + e.username + ':</strong> ' + e.message +  '</div>';
        //console.log(e);
    });
}







