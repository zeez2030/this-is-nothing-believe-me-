// this script is responsible for adding the comment without reloding the page 



var overlay = document.getElementById("overlay");

window.addEventListener('load', function () {
    overlay.style.visibility = 'hidden';
})

commentBtn.addEventListener('click', sendComment);

function sendComment() {
    success.style.visibility = "hidden";
    var comment = document.getElementById('user_comment').value;
    var id = document.querySelector('.author').getAttribute('id');
    var userId = document.querySelector('.getUserId').getAttribute('id');
    var xhr = new XMLHttpRequest();
    // +'&userId=' + userId
    xhr.open('GET', 'includes/data_to_db.php?id=' + id + '&comment=' + comment + '&userId=' + userId, true);

    xhr.onload = function () {
        if (this.status == 200) {
            var success = document.getElementById('success');
            success.textContent = "Your comment is being reviewed... Thank You";
            success.style.visibility = "visible";

        }
    }

    xhr.send();
};