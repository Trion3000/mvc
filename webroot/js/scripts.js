function check() {
    var username = document.getElementById('username');
    var email = document.getElementById('email');
    var message = document.getElementById('message');

    var res = username.value != '' && email.value != '' && message.value != '';

    if (!res) {
        alert('fill');
    }

    return res;
}