

function readNotification(id){

    $.ajax({
        type: "POST",
        url: "/notification/read/" + id
    })
}

function getAllNotifications(){

    return $.ajax({
        type: "GET",
        url: '/notifications',
        success: function (res){
            return res;
        }
    })
}

function changeCount(){
    const notifications = getAllNotifications();
    // const response = notifications.responseJSON;

    notifications.then(res => {

        $('#count').html(res.notifications[0].message.message)
    })
}


// console.log('here')


const varaibles = {}


function setVar(name, value, varaibles = varaibles){
    varaibles = value;
}

function getVar(name, varaibles = varaibles)
{
    return varaibles[name]
}


