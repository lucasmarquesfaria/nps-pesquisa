if (sessionStorage.getItem("reload")) {
    sessionStorage.removeItem("reload");
    location.reload();
}

function markPageReload() {
    sessionStorage.setItem("reload", "true");
}

function submitScore(score) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "process.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
            document.querySelector(".nps-buttons").style.display = "none";
            document.getElementById("thankYouMessage").style.display = "block";
            markPageReload();

            setTimeout(function() {
                window.location.href = "index.php"; 
            }, 1009); 
        }
    };
    xhr.send("score=" + score);
}
