let search = document.getElementById('searchBtn');
let close = document.getElementById('closeBTN');
let commentBtn = document.getElementById('getform');
search.addEventListener('click', showModal);
close.addEventListener('click', closeModal);

function showModal() {
    document.getElementById('whitepage').style.visibility = "visible";
    document.getElementById('whitepage').style.opacity = "0.94";
    var tb = document.getElementById("scriptBox");
    tb.addEventListener('keyup', function (e) {
        if (e.keyCode == 13) {
            let tag = tb.value;
            window.location.href = "search.php?search=" + tag;
        }

    })

}

function closeModal() {
    document.getElementById('whitepage').style.visibility = "hidden";
    document.getElementById('whitepage').style.opacity = "0";
}

function formatDate(date) {
    var t = date.split(/[- :]/);
    var d = new Date(t[0], t[1] - 1, t[2], t[3], t[4]);
    return d;
}

let recent = document.querySelector("#recent");
let popular = document.querySelector("#popular");
let span = document.createElement('span');
let id = document.querySelector('.get-id').getAttribute("id");
let posts = document.getElementById('posts');
let showMore = document.querySelector("#show-more");

recent.addEventListener('click', addactiverec);
popular.addEventListener('click', addactivepop);

function addactiverec() {
    popular.classList.remove("active");
    recent.classList.add("active");
    showMore.style.visibility = "visible";
    recent.appendChild(span);
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'includes/recent.inc.php?id=' + parseInt(id, 10), true);

    xhr.onload = function () {
        if (this.status == 200) {
            document.getElementById('posts').innerHTML = "";
            let posts = JSON.parse(this.responseText);

            var output = '';
            for (var i in posts) {

                output = '<a href = "post.php ?id=' + posts[i].id + '" class="card col-md-5 border-light bg-light mb-3 ">' +
                    '<img class="card-img-top" src="' + posts[i].post_picture + '" alt="Card image cap">' +
                    ' <div class="card-body"><h5 class = "card-title"> <i class ="fa fa-user" aria-hidden = "true" > </i> ' + posts[i].post_author + ' <i class = "fa fa-wifi card-icon text-center" aria - hidden = "true"></i> </h5>' +
                    ' <p class = "text-muted card-date" >' + formatDate(posts[i].post_date).toDateString() + '</p>' +
                    ' <p class = "card-text text-center">' + posts[i].post_title + '</p> ' + ' </div>' +
                    '</a>';
                document.getElementById('posts').innerHTML += output;
            }


        }
    }
    xhr.send();

}

function addactivepop() {

    popular.classList.add("active");
    showMore.style.visibility = "visible";
    popular.appendChild(span);
    recent.classList.remove("active");
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'includes/popular.inc.php?id=' + parseInt(id, 10), true);

    xhr.onload = function () {
        if (this.status == 200) {
            document.getElementById('posts').innerHTML = "";
            let posts = JSON.parse(this.responseText);
            let output = '';
            for (var i in posts) {

                output = '<a href = "post.php?id=' + posts[i].id + '" class="card col-md-5 border-light bg-light mb-3 ">' +
                    '<img class="card-img-top" src="' + posts[i].post_picture + '" alt="Card image cap">' +
                    ' <div class="card-body"><h5 class = "card-title"> <i class ="fa fa-user" aria-hidden = "true" > </i> ' + posts[i].post_author + ' <i class = "fa fa-wifi card-icon text-center" aria - hidden = "true"></i> </h5>' +
                    ' <p class = "text-muted card-date" >' + formatDate(posts[i].post_date).toDateString() + '</p>' +
                    ' <p class = "card-text text-center">' + posts[i].post_title + '</p> ' + ' </div>' +
                    '</a>';

                document.getElementById('posts').innerHTML += output;
            }

        }
    }
    xhr.send();

}
showMore.addEventListener('click', function () {

    showMore.style.visibility = "hidden";
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'includes/show_all_cat.inc.php?id=' + parseInt(id, 10), true);

    xhr.onload = function () {
        if (this.status == 200) {
            document.getElementById('posts').innerHTML = "";
            let posts = JSON.parse(this.responseText);
            let output = '';
            for (var i in posts) {

                output = '<a href = "post.php ? id =' + posts[i].id + '" class="card col-md-5 border-light bg-light mb-3 ">' +
                    '<img class="card-img-top" src="' + posts[i].post_picture + '" alt="Card image cap">' +
                    ' <div class="card-body"><h5 class = "card-title"> <i class ="fa fa-user" aria-hidden = "true" > </i> ' + posts[i].post_author + ' <i class = "fa fa-wifi card-icon text-center" aria - hidden = "true"></i> </h5>' +
                    ' <p class = "text-muted card-date" >' + formatDate(posts[i].post_date).toDateString() + '</p>' +
                    ' <p class = "card-text text-center">' + posts[i].post_title + '</p> ' + ' </div>' +
                    '</a>';
                document.getElementById('posts').innerHTML += output;
            }

        }
    }
    xhr.send();
})