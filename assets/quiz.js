let zid = null;

(function() {

    document.getElementById("zid").addEventListener("keyup", (e) => {
        if (e.code != "Enter") return;
        else if (e.srcElement.value.match(/(z|Z)\d{7}/) === null) {
            alert("Invalid zID");
            return;
        }

        zid = e.srcElement.value;

        document.getElementById('title').style.display = 'none';

        e.srcElement.disabled = true; document.getElementById("zidholder").style.display = "none";

        document.getElementById("memery").style.display = "block";
    });

})();

let letmein = () => {
    let e = document.getElementById("zid");

    if (e.value.match(/(z|Z)\d{7}/) === null) {
        alert("Invalid zID");
        return;
    }

    zid = e.value;

    document.getElementById('title').style.display = 'none';

    e.disabled = true; document.getElementById("zidholder").style.display = "none";

    document.getElementById("memery").style.display = "block";
}

let submit = () => {
    let final = {
        zid: zid,
        answers: []
    };

    document.querySelectorAll("select").forEach((el) => {
        final.answers.push(el.value);
    });

    console.log(final);

    $.post("submit.php?q=" + qid, final, (data) => {
        data = JSON.parse(data);

        if (typeof data.error !== "undefined") {
            alert("Something went wrong!");
            return;
        } else {
            document.getElementById("memery").style.display = "none";

            document.getElementById("success").style.display = "block";
        }
    });
}
