<?php
    include("header.php");
?>
<body>

<script>
    $(document).ready(function(){
        let ajaxSuccess;
        let loadTime;
        let time;

        $.ajax({
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                xhr.addEventListener("progress", function(evt){
                    if (evt.lengthComputable) {
                        loadTime = evt.total;
                        time = evt.total;
                        var percentComplete = evt.loaded / evt.total;
                        $("#progress").html(evt.loaded);
                        console.log(evt.loaded + " / " + evt.total);
                    }
                }, false);
                return xhr;
            },
            url: "canvas.php", success:function(result){
                ajaxSuccess = result;
            },
            complete:function(){
                showCanvas();
                $("#progress").hide();
            }
        });
        function downloadTime(){
            $("#progress").html(time);
        }
        function showCanvas(){
            $("#canvas").html(ajaxSuccess);
        }
    });

</script>
<div id="progress"></div>
<div id="canvas"></div>
</body>
<?php
    include("footer.php");
?>