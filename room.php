<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input[type="radio"] {
            display: none;
        }

        #gui {
            display: none;
        }

        #tong {
            display: flex;
            flex-wrap: wrap;
        }

        #hien {
            margin-top: 69px;
            padding-left: 50px;
        }

        label {
            text-decoration: underline;
            color: blue;
            cursor: pointer;
        }
    </style>
    <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('576aec32d50bd84ba5f3', {
            cluster: 'ap1'
        });

        var channel = pusher.subscribe('<?php echo $_SESSION['id'];  ?>');
        channel.bind('nhan_tin', function(data) {
            document.getElementById("hien").innerHTML += data['ng_gui'] + ": " + data['nd'] + "<br>";
        });
    </script>
</head>

<body>
    <div id="tong">
        <div>
            <h2>
                xin chào <?php echo $_SESSION['ten']; ?>
            </h2>
            <p>danh sách người online</p>
            <div id="app">
            </div>
            <div id="gui">
                <div id="hidden">
                </div>
                <textarea id="nd"></textarea><Br>
                <button onclick="gui()"></button>
            </div>
        </div>
        <div id="hien">
        </div>
    </div>
    <script>
        var app = document.getElementById("app");
        setInterval(() => {
            let xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (this.readyState == this.DONE && this.status == 200) {
                    app.innerHTML = "";
                    var data = JSON.parse(this.response);
                    data.forEach(function(item) {
                        app.innerHTML += "<label onclick='nhan(this)' for='" + item.id + "'>" + item.ten + "</label>";
                        app.innerHTML += "<input type='radio' name='input' id='" + item.id + "' value='" + item.id + "'>";
                        app.innerHTML += "<br>";
                    })
                }
            }
            xhr.open("POST", "api.php?id=<?php echo $_SESSION['id']; ?>", true);
            xhr.send();
        }, 3000);

        function nhan(el) {
            document.getElementById("gui").style.display = "block";
            document.querySelector("#gui button").innerHTML = "gủi cho " + el.textContent;
            setTimeout(() => {
                document.getElementsByName("input").forEach(item => {
                    if (item.checked == true) {
                        document.querySelector("#hidden").innerHTML = "<input type='hidden' id='hiddent' value='" + item.value + "'>";
                    }
                })
            }, 100);
        }
        document.querySelector("#gui button").addEventListener("click", () => {
            let xhr = new XMLHttpRequest();
            let data = new FormData();
            data.append("nd", document.getElementById("nd").value);
            data.append("id", document.getElementById("hiddent").value);
            data.append("ng_gui", "<?php echo $_SESSION['ten']; ?>");
            xhr.onreadystatechange = function() {
                if (this.readyState == this.DONE && this.status == 200) {
                    document.getElementById("hien").innerHTML += "you: " + document.getElementById("nd").value + "<br>";
                }
            }
            xhr.open("POST", "./nhan_tin.php", true);
            xhr.send(data);
        })
    </script>
</body>

</html>